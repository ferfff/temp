<?php

namespace App\Http\Controllers;

use App\Exports\ContratoExport;
use App\Http\Requests\ContratoStoreRequest;
use App\Http\Requests\ContratoUpdateRequest;
use App\Imports\ControlObraImport;
use App\Models\Cliente;
use App\Models\CodigoPostal;
use App\Models\Colonia;
use App\Models\Contrato;
use App\Models\DefinicionDocumento;
use App\Models\Estado;
use App\Models\Expediente;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Presupuesto;
use App\Models\Siroc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ContratoController
 * @package App\Http\Controllers
 */
class ContratoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:contratos.index')->only('index');
        $this->middleware('can:contratos.store')->only('create', 'store');
        $this->middleware('can:contratos.update')->only('edit', 'update');
        $this->middleware('can:contratos.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->buscar) || isset($request->activo)) {
            toastr('Se ha actualizado la información.', 'info');
        }
        return view('Catalogos.contrato.index', [
            'contratos' => Contrato::search($request->buscar, $request->activo)
                ->when($request->tipo == 1, fn($query) => $query->where('tipo', 0))
                ->when($request->tipo == 2, fn($query) => $query->where('tipo', 1))
                ->with(['municipio:id,nombre', 'estado:id,nombre'])->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
            'tipo' => $request->tipo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Catalogos.contrato.create', [
            'contrato' => new Contrato(),
            'estados' => Estado::pluck('nombre', 'id'),
            'municipios' => Municipio::whereHas('estado', fn($query) => $query->where('id', 0))->pluck('nombre', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ContratoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoStoreRequest $request)
    {
        $contrato = null;
        DB::transaction(function () use ($request, $contrato) {
            $contrato = Contrato::create($request->all());

            request()->contrato_id = $contrato->uid;
            $presupuesto = Presupuesto::whereRelation('contrato', 'id', $contrato->id)->first();
            $siroc = Siroc::whereRelation('contrato', 'id', $contrato->id)->first() ??
            Presupuesto::select('sirocs.archivo', 'sirocs.descripcion')->join('sirocs', 'presupuestos.id', '=', 'sirocs.presupuesto_id')->whereRelation('contrato', 'id', $contrato->id)->first();

            if ($request->archivo != null) {
                $contrato->expedientes()->create([
                    'nombre' => $request->archivo->getClientOriginalName(),
                    'extension' => 'pdf',
                    'ruta' => '/docs/' . $request->folio . '/archivos/' . $request->archivo->getClientOriginalName(),
                    'comentario' => 'Documento tomado desde la creacion del contrato',
                    'documento_id' => DefinicionDocumento::where('nombre', Parametro::first()->contrato)->first()->id,
                    'condicion_id' => 1,
                    'grupo' => 1,
                ]);
                $request->archivo->move(public_path() . '/docs/' . $request->folio . '/archivos', $request->archivo->getClientOriginalName());
            }
            if ($presupuesto != null) {
                $contrato->expedientes()->create([
                    'nombre' => $presupuesto->archivo,
                    'extension' => 'pdf',
                    'ruta' => $presupuesto->archivo,
                    'comentario' => $presupuesto->descripcion,
                    'documento_id' => DefinicionDocumento::where('nombre', Parametro::first()->presupuesto)->first()->id,
                    'condicion_id' => 1,
                    'grupo' => 1,
                ]);
            }
            if ($siroc != null) {
                $contrato->expedientes()->create([
                    'nombre' => $siroc->archivo,
                    'extension' => 'pdf',
                    'ruta' => $siroc->archivo,
                    'comentario' => $siroc->descripcion,
                    'documento_id' => DefinicionDocumento::where('nombre', Parametro::first()->siroc)->first()->id,
                    'condicion_id' => 1,
                    'grupo' => 1,
                ]);
            }
        });
        return response()->json($contrato);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contrato $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::whereUid($id)->with(['cliente:id,razon_social', 'model'])->first();
        return view('Catalogos.contrato.edit', [
            'contrato' => $contrato,
            'estados' => Estado::pluck('nombre', 'id'),
            'municipios' => Municipio::pluck('nombre', 'id'),
            'documentos' => DefinicionDocumento::select('id', 'nombre', 'obligatorio', 'solicita_aprobacion')->get(),
            'expedientes' => Expediente::select('id', 'documento_id as documento', 'condicion_id as condicion')
                ->whereRelation('contrato', 'uid', $id)->orderBy('documento_id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ContratoUpdateRequest $request
     * @param  Contrato $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoUpdateRequest $request, Contrato $contrato)
    {
        $contrato->update($request->all());
        return response()->json($contrato);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        Contrato::where('id', $request->slug)->first()->delete();
        toastr('El registro se elimino con exito.');
        return back();
    }

    public function restore(Request $request, $id)
    {
        Contrato::onlyTrashed()->where('id', $request->slug)->first()->restore();
        toastr('El registro se restauro con exito.');
        return back();
    }

    public function municipios($id)
    {
        $results = Municipio::with('estado:id,nombre')
            ->whereHas('estado', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();
        return response()->json($results);
    }

    public function cp(Request $request)
    {
        $results = CodigoPostal::where('CP', 'LIKE', '%' . $request->search . '%')
            ->whereRelation('municipio', 'id', $request->municipio)
            ->limit(10)
            ->pluck('CP', 'id');
        if (count($results) == 0) {
            $results = [[0 => 'No se encontro ningun registro']];
        }
        return response()->json($results);
    }

    public function colonias(Request $request)
    {
        $results = Colonia::where('nombre', 'LIKE', '%' . $request->search . '%')
            ->whereRelation('codigoPostal.municipio', 'id', $request->municipio)
            ->when(empty($request->cp) == false, fn($query) => $query->whereRelation('codigoPostal', 'CP', $request->cp))
            ->when(empty($request->cp) == true, fn($query) => $query->orWhereRelation('codigoPostal', 'CP', $request->cp))
            ->distinct()
            ->limit(10)
            ->pluck('nombre', 'id');
        if (count($results) == 0) {
            $results = [[0 => 'No se encontro ningun registro']];
        }
        return response()->json($results);
    }

    public function clientes(Request $request)
    {
        $results = Cliente::where('razon_social', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->pluck('razon_social', 'id');
        if (count($results) == 0) {
            $results = [[0 => 'No se encontro ningun registro']];
        }
        return response()->json($results);
    }

    public function import(Request $request)
    {
        $uid = uniqid();
        $time = time();
        $contrato = Contrato::where('uid', $request->uid)->first();
        $contrato->update([
            'documento_partidas' => '/docs/presupuestos/' . $request->uid . '/' . $time . '_' . $request->file->getClientOriginalName(),
        ]);
        (new ControlObraImport)->import($request->file);
        $request->file->move(public_path() . '/docs/definiciones/' . $request->uid . '/', $time . '_' . $request->file->getClientOriginalName());
        return response()->json($contrato);
    }

    public function export($id)
    {
        return (new ContratoExport)->forId($id)->download('contrato.xlsx');
    }

    public function presupuesto_siroc(Request $request)
    {
        $presupuesto = Cliente::select('presupuesto', 'siroc')->where('razon_social', $request->cliente_id)->withTrashed()->first();
        return response()->json($presupuesto);
    }

    public function base($modelo)
    {
        $registros = $modelo == 'Presupuesto'
        ? Presupuesto::select('presupuestos.id', 'presupuestos.folio', 'clientes.razon_social')
            ->join('clientes', 'clientes.id', '=', 'presupuestos.cliente_id')
            ->doesntHave('contrato')
            ->where('estado', 'Aprobado')
            ->get()
        : Siroc::select('sirocs.id', 'sirocs.folio', 'clientes.razon_social')
            ->join('clientes', 'clientes.id', '=', 'sirocs.cliente_id')
            ->doesntHave('contrato')
            ->doesntHave('presupuesto')
            ->get();
        return response()->json($registros);
    }

    public function datos($modelo, $id)
    {
        $data = $modelo == 'Presupuesto'
        ? Presupuesto::select('clientes.razon_social', 'presupuestos.folio', 'presupuestos.monto', DB::raw('CONCAT(presupuestos.descripcion, sirocs.descripcion) AS descripcion'),
            'sirocs.fecha_firma', 'sirocs.fecha_cierre_siroc')
            ->join('clientes', 'clientes.id', '=', 'presupuestos.cliente_id')
            ->leftJoin('sirocs', 'sirocs.presupuesto_id', '=', 'presupuestos.id')
            ->where('presupuestos.id', $id)
            ->where('presupuestos.estado', 'Aprobado')
            ->first()
        : Siroc::select('clientes.razon_social', 'sirocs.folio', 'sirocs.descripcion AS descripcion', 'sirocs.fecha_firma', 'sirocs.fecha_cierre_siroc')
            ->join('clientes', 'clientes.id', '=', 'sirocs.cliente_id')
            ->where('sirocs.id', $id)->first();
        return response()->json($data);
    }
}
