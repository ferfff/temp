<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpedienteStoreRequest;
use App\Models\BitacoraMovimiento;
use App\Models\Contrato;
use App\Models\DefinicionDocumento;
use App\Models\Expediente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:expedientes.index')->only('index');
        $this->middleware('can:expedientes.store')->only('store');
        $this->middleware('can:expedientes.update')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->buscar) || isset($request->activo) || isset($request->pendiente)) {
            toastr('Se ha actualizado la información.', 'info');
        }
        $total_documentos = DefinicionDocumento::selectRaw('COUNT(id) as total')->first()->total;
        return view('Procesos.expediente.index', [
            'contratos' => Contrato::contrato($request->buscar)
                ->with('cliente', 'municipio', 'estado')
                ->withCount([
                    'expedientes as pendientes' => fn($query) => $query->where('condicion_id', '!=', 1)
                        ->where(fn($query) => $query->whereRelation('documento', 'obligatorio', 1)->orWhereRelation('documento', 'solicita_aprobacion', 1)),
                    'expedientes as pendientes_obligatorio' => fn($query) => $query->where('condicion_id', '!=', 1)
                        ->whereRelation('documento', 'obligatorio', 1),
                    'expedientes as total' => fn($query) => $query->select(DB::raw('COUNT(DISTINCT documento_id)')),
                    'expedientes as documentos_obligatorio' => fn($query) => $query->whereRelation('documento', 'obligatorio', 1),
                    'expedientes as documentos_opcionales' => fn($query) => $query->select(DB::raw('COUNT(DISTINCT documento_id)'))->whereRelation('documento', 'obligatorio', 0),
                    'expedientes as seguimientos' => fn($query) => $query->whereRelation('documento', 'seguimiento', 1)
                        ->where('seguimiento', '<', date("Y-m-d"))->whereNotNull('seguimiento')->doesntHave('seguidos')->where('condicion_id', 3),
                ])
                ->when($request->activo == 2, fn($query) => $query->having('pendientes_obligatorio', '>', 0)->OrHaving('total', '<', $total_documentos))
                ->when($request->activo == 1, fn($query) => $query->having('pendientes_obligatorio', 0)->having('total', '>=', $total_documentos))
                ->when($request->pendiente == 2, fn($query) => $query->having('pendientes', '>', 0))
                ->when($request->pendiente == 1, fn($query) => $query->having('total', '<', $total_documentos))
                ->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
            'pendiente' => $request->pendiente,
            'total_documentos' => $total_documentos,
            'total_documentos_obligatorios' => DefinicionDocumento::selectRaw('COUNT(id) as total')->where('obligatorio', 1)->first()->total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExpedienteStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedienteStoreRequest $request)
    {
        $expediente = [];
        $old = Expediente::where('id', $request->nodo_id)->first();
        $documento = $request->nodo_id == null ? DefinicionDocumento::without('ciclo')->where('uuid', $request->documento_id)->first() :
        DefinicionDocumento::without('ciclo')->whereRelation('expedientes', 'id', $request->nodo_id)->first();
        $uid = uniqid();
        $time = time();
        foreach ($request->file as $file) {
            $expediente[] = Expediente::create([
                'nombre' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'ruta' => '/docs/' . $request->folio . '/archivos/' . $uid . '_' . $time . '_' . $file->getClientOriginalName(),
                'comentario' => $request->comentario,
                'documento_id' => $request->nodo_id == null ? $documento->id : $old->documento_id,
                'contrato_id' => $request->contrato_id,
                'condicion_id' => $documento->solicita_aprobacion == 1 ? 3 : 1,
                'grupo' => $request->nodo_id == null ? $request->grupo : $old->grupo + 1,
                'seguimiento' => $request->seguimiento,
                'aplazamiento' => $request->aplazamiento,
                'nodo_id' => $request->nodo_id,
            ]);
            $file->move(public_path() . '/docs/' . $request->folio . '/archivos', $uid . '_' . $time . '_' . $file->getClientOriginalName());
        }
        return response()->json($expediente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return view('Procesos.expediente.show', [
            'total_documentos' => DefinicionDocumento::selectRaw('COUNT(id) as total')->where('obligatorio', 1)->first()->total,
            'contrato' => Contrato::select('id', 'uid', 'folio', 'cliente_id')
                ->with('cliente:id,razon_social')
                ->withCount([
                    'expedientes as pendientes_obligatorio' => fn($query) => $query->where('condicion_id', '!=', 1)
                        ->whereRelation('documento', 'obligatorio', 1),
                    'expedientes as documentos_obligatorio' => fn($query) => $query->whereRelation('documento', 'obligatorio', 1),
                    'expedientes as documentos_opcionales' => fn($query) => $query->select(DB::raw('COUNT(DISTINCT documento_id)'))->whereRelation('documento', 'obligatorio', 0),
                    'expedientes as seguimientos' => fn($query) => $query->whereRelation('documento', 'seguimiento', 1)
                        ->where('seguimiento', '<', date("Y-m-d"))->whereNotNull('seguimiento')->doesntHave('seguidos')->where('condicion_id', 3),
                ])->where('uid', $id)->first(),
            'expedientes' => DefinicionDocumento::withCount([
                'expedientes as pendientes' => fn($query) => $query->where('condicion_id', '!=', 1)
                    ->whereRelation('contrato', 'uid', $id)
                    ->where(fn($query) => $query->whereRelation('documento', 'obligatorio', 1)->orWhereRelation('documento', 'solicita_aprobacion', 1))
                    ->whereColumn('expedientes.documento_id', 'definicion_documentos.id'),
                'expedientes as total' => fn($query) => $query->whereRelation('contrato', 'uid', $id)
                    ->whereColumn('expedientes.documento_id', 'definicion_documentos.id'),
            ])
                ->without('ciclo')
                ->where('obligatorio', 1)
                ->having('total', 0)
                ->orHaving('pendientes', '>', 0)
                ->get(),
            'documentos' => DefinicionDocumento::select('id', 'uuid', 'nombre', 'obligatorio', 'solicita_aprobacion', 'multiple', 'ciclo_id')
                ->withCount(['expedientes as total' => fn($query) => $query->whereRelation('contrato', 'uid', $id)])
                ->with([
                    'expedientes' => fn($query) => $query->select('id', 'documento_id', 'condicion_id', 'grupo')->whereRelation('contrato', 'uid', $id),
                ])->orderBy('ciclo_id')->orderBy('nombre')->get(),
            'seguidos' => DefinicionDocumento::select('id', 'nombre')
                ->withCount([
                    'expedientes' => fn($query) => $query->whereRelation('documento', 'seguimiento', 1)
                        ->where('seguimiento', '<', date("Y-m-d"))->whereNotNull('seguimiento'),
                ])->having('expedientes_count', '>', 0)->get(),
            'total_documentos_obligatorios' => DefinicionDocumento::selectRaw('COUNT(id) as total')->where('obligatorio', 1)->first()->total,
        ]);
    }

    public function update(Request $request, $id)
    {
        $expediente = Expediente::where('id', $request->expediente_id)->first();
        $expediente->update([
            'condicion_id' => $request->condicion_id,
        ]);
        $expediente->bitacora()->create([
            'comentario' => $request->comentario,
            'user' => $request->user,
            'accion' => $request->accion,
        ]);
        return response()->json($expediente);
    }

    public function destroy(Request $request, $id)
    {
        $expediente = Expediente::withCount('seguidos')->where('id', $request->expediente_id)->first();
        if ($expediente->seguidos_count == 0) {
            $expediente->delete();
        }
        return response()->json($expediente);
    }

    public function docs(Request $request)
    {
        $request->file('file')->move('docs/' . $request->folio . '/archivos', $request->file('file')->getClientOriginalName());
    }

    public function cambio(Request $request)
    {
        $expediente = Expediente::where('id', $request->expediente_id)->first();

        $comentario = DefinicionDocumento::without('ciclo')->where('uuid', $request->documento_id)->first()->nombre . '->' .
        $expediente->documento->nombre . ' ' . $request->comentario;

        $expediente->update([
            'documento_id' => DefinicionDocumento::without('ciclo')->where('uuid', $request->documento_id)->first()->id,
            'condicion_id' => DefinicionDocumento::without('ciclo')->where('uuid', $request->documento_id)->first()->solicita_aprobacion == 1 ? 3 : 1,
        ]);

        $expediente->bitacora()->create([
            'comentario' => $comentario,
            'user' => $request->user,
            'accion' => $request->accion,
        ]);
        toastr('El registro se modifico con exito.');
        return back();
    }

    public function bitacora($id)
    {
        $results = BitacoraMovimiento::whereHasMorph(
            'model',
            Expediente::class,
            fn($query) => $query->where('id', $id)
        )->get();
        return datatables()->of($results)->toJson();
    }

    public function aplazamiento_seguimiento(Request $request)
    {
        return response()->json(DefinicionDocumento::select('nombre', 'seguimiento', 'aplazamiento')->where('uuid', $request->documento_id)->without('ciclo')->withTrashed()->first());
    }

    public function tree(Request $request)
    {
        $expediente = Expediente::select('id', 'nodo_id as parent', DB::raw('CONCAT(DATE_FORMAT(created_at,"%d/%m/%Y")," ", grupo) AS text'))
            ->with('condicion')
            ->whereRelation('contrato', 'uid', $request->contrato_id)
            ->whereRelation('documento', 'id', DefinicionDocumento::where('uuid', $request->documento_id)->first()->id)
            ->orderBy('grupo')
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json($expediente);
    }

    public function table(Request $request)
    {
        list($fecha, $grupo) = explode(' ', $request->fecha);
        $expediente = Expediente::select('id', 'grupo', 'ruta', 'condicion_id', 'comentario', 'seguimiento', 'extension')
            ->with('condicion')
            ->whereRaw('date(created_at) = ?', [Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d')])
            ->where('grupo', $grupo)
            ->whereRelation('contrato', 'uid', $request->contrato_id)
            ->whereRelation('documento', 'id', DefinicionDocumento::where('uuid', $request->documento_id)->first()->id)
            ->orderBy('grupo')
            ->orderBy('id', 'DESC')
            ->get();
        return datatables()->of($expediente)->toJson();
    }
}
