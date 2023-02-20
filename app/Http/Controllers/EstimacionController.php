<?php

namespace App\Http\Controllers;

use App\Events\EstimacionEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstimacionRequest;
use App\Mail\EstimacionMail;
use App\Models\BitacoraMovimiento;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Estimacion;
use App\Models\EstimacionArchivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

class EstimacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:estimaciones.index')->only('index', 'show');
        $this->middleware('can:estimaciones.store')->only('store');
        Settings::setPdfRendererName('DomPDF');
        Settings::setPdfRendererPath(realpath('../vendor/dompdf/dompdf'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->buscar)) {
            toastr('Se a actualizado la información.', 'info');
        }
        return view('Procesos.estimacion.index', [
            'contratos' => Contrato::withSum(
                ['estimaciones as total_pagadas' => fn($query) => $query->where('estado', 'Pagada')
                        ->whereNotIn('estado', ['Rechazada', 'Cancelada'])],
                'monto_facturar')
                ->withSum(
                    ['estimaciones as total_en_proceso' => fn($query) => $query->whereNotIn('estado', ['Rechazada', 'Cancelada', 'Pagada'])],
                    'monto_facturar')
                ->with(['cliente', 'municipio', 'estado',
                    'estimaciones' => fn($query) => $query->latest()->first(),
                ])->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstimacionRequest $request)
    {
        $contrato = Contrato::where('id', $request->contrato_id)->first();
        $estimacion = null;

        DB::transaction(function () use ($request, $contrato, $estimacion) {
            $estimacion = Estimacion::create([
                'id' => $request->id,
                'contrato_id' => $request->contrato_id,
                'fecha_estimacion' => $request->fecha_estimacion,
                'no_estimacion' => $request->no_estimacion,
                'monto_ejecutar' => $request->monto_ejecutar,
                'monto_facturar' => $request->monto_facturar,
                'estado' => $request->estado,
                'comentario' => $request->comentario,
                'retencion_monto' => $request->retencion_monto,
                'retencion_porcentaje' => $request->retencion_porcentaje,
                'total_facturar' => $request->total_facturar,
                'amortizacion_monto' => $request->amortizacion_monto,
                'amortizacion_porcentaje' => $request->amortizacion_porcentaje,
            ]);
            event(new EstimacionEvent($estimacion, $contrato->uid, 'Estimacion', 5));
        });
        return response()->json($estimacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (Cliente::whereRelation('contratos', 'uid', $id)->first()->expediente == 1) {
            toastr('Se necesita que el expediente este completo para empezar con el proceso de estimaciones.', 'warning');
            return back();
        }

        toastr('El expediente esta incompleto pero puede agregar estimaciones.', 'info');
        return view('Procesos.estimacion.show', [
            'estimaciones' => Estimacion::addSelect(['max' => Estimacion::select('no_estimacion')
                    ->latest()->whereHas('contrato', function ($query) use ($id) {
                    $query->where('uid', $id);
                })->take(1)])
                ->with([
                    'archivos' => fn($query) => $query->latest(),
                ])->whereHas('contrato', function ($query) use ($id) {
                $query->where('uid', $id);
            })->get(),
            'contrato' => Contrato::withSum(
                ['estimaciones as total_estimado' => fn($query) => $query->whereNotIn('estado', ['Rechazada', 'Cancelada'])],
                'monto_facturar')
                ->withSum(
                    ['estimaciones as total_pagadas' => fn($query) => $query->where('estado', 'Pagada')
                            ->whereNotIn('estado', ['Rechazada', 'Cancelada'])],
                    'monto_facturar')
                ->withSum(
                    ['estimaciones as total_pendiente' => fn($query) => $query->whereNotIn('estado', ['Rechazada', 'Cancelada', 'Pagada'])->where('estado', 'Pendiente')],
                    'monto_facturar')
                ->withSum(
                    ['estimaciones as total_proceso' => fn($query) => $query->whereNotIn('estado', ['Pendiente', 'Rechazada', 'Cancelada', 'Pagada'])],
                    'monto_facturar')
                ->withCount([
                    'estimaciones',
                    'estimaciones as estimacion_revision' => fn($query) => $query->where('estado', 'Revision'),
                    'estimaciones as estimacion_cliente' => fn($query) => $query->where('estado', 'Cliente'),
                    'estimaciones as estimacion_pendiente' => fn($query) => $query->where('estado', 'Pendiente'),
                    'estimaciones as estimacion_cancelada' => fn($query) => $query->where('estado', 'Cancelada'),
                    'estimaciones as estimacion_rechazada' => fn($query) => $query->where('estado', 'Rechazada'),
                    'estimaciones as estimacion_pagada' => fn($query) => $query->where('estado', 'Pagada'),
                ])
                ->with('cliente:id,razon_social', 'municipio', 'estado')
                ->where('uid', $id)->first(),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $estimacion = EstimacionArchivo::where('id', $request->estimacion_id)->first();
        $response = $estimacion->delete();
        return response()->json($response);
    }

    public function upload_documents(Request $request)
    {
        $contrato = Contrato::where('id', $request->contrato_id)->first();
        $estimacion = Estimacion::where('uuid', $request->estimacion_id)->first();
        $uid = uniqid();
        $time = time();
        $archivos = [];
        foreach ($request->archivos as $file) {
            $archivos[] = $estimacion->archivos()->create([
                'nombre' => '/docs/' . $contrato->folio . '/estimaciones/' . $time . '_' . $estimacion->no_estimacion . '/' . $uid . '_' . $time . '_' . Str::slug($file->getClientOriginalName()),
                'extension' => $file->getClientOriginalExtension(),
                'tipo' => $request->tipo,
            ]);
            $file->move(public_path() . '/docs/' . $contrato->folio . '/estimaciones/' . $time . '_' . $estimacion->no_estimacion, $uid . '_' . $time . '_' . $file->getClientOriginalName());
        }
        return response()->json($archivos);
    }

    public function documentos(Request $request)
    {
        $results = EstimacionArchivo::select('id', 'nombre', 'extension', 'tipo', 'estimacion_id', 'deleted_at as activo')
            ->with(['estimacion:id,estado'])
            ->whereRelation('estimacion', 'uuid', $request->estimacion_id)
            ->get();
        return datatables()->of($results)->toJson();
    }

    public function documentos_cliente(Request $request)
    {
        $results = EstimacionArchivo::select('nombre', 'tipo')
            ->whereRelation('estimacion', 'id', $request->estimacion_id)
            ->get()
            ->unique('tipo');
        return response()->json($results);
    }

    public function cliente(Request $request)
    {
        $cliente = Cliente::with(['correos' => fn($query) => $query->where('tipo_proceso', 'Estimacion Cliente')])
            ->where('id', $request->cliente_id)
            ->first();
        $to = [];
        foreach ($cliente->correos as $value) {
            $to[] = $value->correo;
        }
        $contrato = Contrato::where('uid', $request->contrato_id)->first();
        $estimacion = Estimacion::where('id', $request->estimacion_id)->first();
        $archivo = $this->juntar_documento(explode(',', $request->documentos), $contrato);
        $estimacion->update([
            'estado' => 'Cliente',
        ]);
        $estimacion->bitacora()->create([
            'comentario' => 'Enviado al cliente ' . $estimacion->created_at,
            'user' => Auth()->user()->fullname,
            'accion' => 'Enviado al Cliente',
        ]);
        if (count($to) > 0) {
            Mail::to($to)->send(new EstimacionMail($estimacion, $contrato, $cliente->razon_social, 9, $archivo));
        }
        return back();
    }

    public function download_documento(Request $request)
    {
        $contrato = Contrato::where('uid', $request->contrato_id)->first();
        $archivo = $this->juntar_documento(explode(',', $request->documentos), $contrato, 'browser');
    }

    public function juntar_documento($archivos, Contrato $contrato, $output = 'file'): string
    {
        $pdfMerger = PDFMerger::init();
        $destino = public_path('/docs/' . $contrato->folio . '/estimaciones/Documento.pdf');
        for ($i = 0; $i < count($archivos); $i++) {
            $estimacion = EstimacionArchivo::where('nombre', $archivos[$i])->first();
            if (strtolower($estimacion->extension) == 'xml' || strtolower($estimacion->extension) == 'png' ||
                strtolower($estimacion->extension) == 'jpg' || strtolower($estimacion->extension) == 'jpeg') {
                $xmlString = file_get_contents(public_path($estimacion->nombre));
                $pdfMerger->addPDF($this->create_document($xmlString, '/docs/' . $contrato->folio . '/estimaciones/', $estimacion->extension, $estimacion->estimacion_id, $estimacion->tipo), 'all');
            } else {
                $pdfMerger->addPDF(public_path($estimacion->nombre), 'all');
            }
        }
        $pdfMerger->merge();
        $pdfMerger->save($destino, $output);
        return $destino;
    }

    public function aprobar(Request $request)
    {
        $uid = uniqid();
        $time = time();
        $cliente = Cliente::with(['correos' => fn($query) => $query->where('tipo_proceso', 'Estimacion Cliente')])
            ->where('id', $request->cliente_id)
            ->first();
        $to = [];
        foreach ($cliente->correos as $value) {
            $to[] = $value->correo;
        }
        $contrato = Contrato::where('uid', $request->contrato_id)->first();
        $estimacion = Estimacion::where('id', $request->estimacion_id)->first();
        $archivo = EstimacionArchivo::where('estimacion_id', $request->estimacion_id)->latest()->first()->nombre;
        $estimacion->update([
            'estado' => $request->aprobar,
        ]);
        $estimacion->bitacora()->create([
            'comentario' => 'Pendiente de pago',
            'user' => Auth()->user()->fullname,
            'accion' => 'Pendiente de pago',
        ]);
        if ($request->aprobar == 'Pendiente') {
            $estimacion->archivos()->create([
                'nombre' => '/docs/' . $contrato->folio . '/estimaciones/' . $time . '_' . $estimacion->no_estimacion . '/' . $uid . '_' . $time . '_' . $request->file('acuse')->getClientOriginalName(),
                'extension' => $request->file('acuse')->getClientOriginalExtension(),
                'tipo' => 'Acuse',
            ]);
            $request->file('acuse')->move(public_path() . '/docs/' . $contrato->folio . '/estimaciones/' . $time . '_' . $estimacion->no_estimacion, $uid . '_' . $time . '_' . $request->file('acuse')->getClientOriginalName());
        }

        event(new EstimacionEvent($estimacion, $contrato->uid, 'Estimacion Pendiente Pago', 10));

        return back();
    }

    public function dictamen(Request $request)
    {
        $uid = uniqid();
        $time = time();
        $estimacion = Estimacion::where('uuid', $request->id)->first();
        $contrato = Contrato::where('uid', $request->contrato)->first();
        $archivo = null;
        $estimacion->update([
            'estado' => $request->estado,
            'fecha_pago' => $request->file('complemento') != 'undefined'
            ? $request->fecha_pago
            : null,
            'complemento_pago' => $request->file('complemento') != 'undefined'
            ? '/docs/' . $contrato->folio . '/estimaciones/' . $uid . '_' . $time . '_' . $request->file('complemento')->getClientOriginalName()
            : null,
        ]);
        if ($request->file('complemento') != 'undefined') {
            $request->file('complemento')->move(public_path() . '/docs/' . $contrato->folio . '/estimaciones/', $uid . '_' . $time . '_' . $request->file('complemento')->getClientOriginalName());
        }
        $estimacion->bitacora()->create([
            'comentario' => $request->comentario,
            'user' => Auth()->user()->fullname,
            'accion' => $request->estado,
        ]);
        toastr('El registro se modifico con exito.');
        return redirect()->route('estimaciones.show', $request->contrato);
    }

    public function bitacora($id)
    {
        $results = BitacoraMovimiento::whereHasMorph(
            'model',
            [Estimacion::class, EstimacionArchivo::class],
            fn($query, $type) => $type == Estimacion::class ? $query->where('uuid', $id) : $query->whereRelation('estimacion', 'uuid', $id)
        )->get();
        return datatables()->of($results)->toJson();
    }

    public function contrato($id)
    {
        return response()->json(Contrato::where('uid', $id)->first());
    }

    public function create_document($xml, $ruta, $extension = null, $estimacion = null, $tipo = null): string
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        if (strtolower($extension) == 'xml') {
            $section->addText(htmlspecialchars($xml));
        } else {
            $phpWord->addTableStyle('Fancy Table', [
                'borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80,
            ]);
            $table = $section->addTable('Fancy Table');

            $archivos = EstimacionArchivo::where([
                'estimacion_id' => $estimacion,
                'tipo' => $tipo,
            ])->get();
            foreach ($archivos as $key => $archivo) {
                if ($key % 2 == 0) {
                    $table->addRow();
                }
                $table->addCell(2000, ['valign' => 'center'])->addImage(public_path($archivo->nombre), [
                    'positioning' => 'relative',
                    'width' => 250,
                    'wrappingStyle' => 'square',
                ]);
            }
        }
        $objWriter = IOFactory::createWriter($phpWord, 'PDF');
        $objWriter->save(public_path($ruta . 'factura_xml.pdf'));

        return public_path($ruta . 'factura_xml.pdf');
    }

    public function cambio(Request $request)
    {
        $estimacion = EstimacionArchivo::where('id', $request->archivo_id)->first();
        $comentario = $estimacion->tipo . '->' . $request->tipo;

        $estimacion->update([
            'tipo' => $request->tipo,
        ]);
        $estimacion->bitacora()->create([
            'comentario' => $comentario,
            'user' => $request->user,
            'accion' => $request->accion,
        ]);
        return response()->json($estimacion);
    }
}
