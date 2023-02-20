<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresupuestoStoreRequest;
use App\Http\Requests\PresupuestoUpdateRequest;
use App\Models\BitacoraMovimiento;
use App\Models\Cliente;
use App\Models\Presupuesto;
use App\Models\Siroc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class PresupuestoController
 * @package App\Http\Controllers
 */
class PresupuestoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:presupuestos.index')->only('index');
        $this->middleware('can:presupuestos.store')->only('create', 'store');
        $this->middleware('can:presupuestos.update')->only('edit', 'update');
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
        return view('catalogos.presupuesto.index', [
            'presupuestos' => Presupuesto::with(['cliente:id,razon_social', 'contrato:model_id,model_type', 'siroc:presupuesto_id'])
                ->when(empty($request->buscar) == null, fn($query) =>
                    $query->where('folio', 'LIKE', "$request->buscar%")
                        ->orWhereRelation('cliente', 'razon_social', 'LIKE', "%$request->buscar%")
                )
                ->when($request->activo == 1, fn($query) => $query->where('estado', 'Aprobado'))
                ->when($request->activo == 2, fn($query) => $query->orWhere('estado', 'Rechazado'))
                ->when($request->activo == 3, fn($query) => $query->orWhere('estado', 'Espera'))
                ->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogos.presupuesto.create', [
            'presupuesto' => new Presupuesto(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresupuestoStoreRequest $request)
    {
        $presupuesto = null;
        $uid = uniqid();
        $time = time();
        DB::transaction(function () use ($request, $presupuesto, $uid, $time) {
            $presupuesto = Presupuesto::create([
                'folio' => $request->folio,
                'descripcion' => $request->descripcion,
                'cliente_id' => $request->cliente_id,
                'monto' => $request->monto,
                'fecha_recepcion' => $request->fecha_recepcion,
                'archivo' => '/docs/presupuestos/' . $request->cliente_id . '/' . $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName(),
                'estado' => 'Espera',
            ]);
            $request->archivo->move(public_path() . '/docs/presupuestos/' . $request->cliente_id . '/', $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName());
        });
        return response()->json($presupuesto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Presupuesto $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuesto $presupuesto)
    {
        return view('catalogos.presupuesto.edit', [
            'presupuesto' => $presupuesto->load('bitacora'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Presupuesto $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function update(PresupuestoUpdateRequest $request, Presupuesto $presupuesto)
    {
        $uid = uniqid();
        $time = time();
        DB::transaction(function () use ($request, $presupuesto, $uid, $time) {
            $presupuesto->update([
                'folio' => $request->folio,
                'descripcion' => $request->descripcion,
                'cliente_id' => $request->cliente_id,
                'monto' => $request->monto,
                'fecha_recepcion' => $request->fecha_recepcion,
                'archivo' => $request->archivo != 'undefined' ? '/docs/presupuestos/' . $request->cliente_id . '/' . $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName() : $presupuesto->archivo,
                'estado' => 'Espera',
            ]);
            if ($request->archivo != 'undefined') {
                $request->archivo->move(public_path() . '/docs/presupuestos/' . $request->cliente_id . '/', $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName());
            }
        });
        return response()->json($presupuesto);
    }

    public function clientes(Request $request)
    {
        $results = Cliente::select('id', 'razon_social', 'presupuesto')
            ->where('razon_social', 'LIKE', "%$request->search%")
            ->where('presupuesto', 1)
            ->distinct()
            ->limit(10)
            ->get();
        if (count($results) == 0) {
            $results = [['razon_social' => 'No se encontro ningun registro']];
        }
        return response()->json($results);
    }

    public function bitacora($id)
    {
        $results = BitacoraMovimiento::whereHasMorph(
            'model',
            Presupuesto::class,
            fn($query) => $query->where('id', $id)
        )->get();
        return datatables()->of($results)->toJson();
    }

    public function aprobar(Request $request)
    {
        $presupuesto = null;
        DB::transaction(function () use ($request, $presupuesto) {
            $presupuesto = Presupuesto::where('id', $request->id)->first();
            $presupuesto->update([
                'estado' => $request->estado == 'true' ? 'Aprobado' : 'Rechazado',
            ]);
        });
        return response()->json($presupuesto);
    }

    public function folio(Request $request)
    {
        $results = Siroc::select('id', 'folio', 'presupuesto_id')
            ->where('folio', $request->term)
            ->with('contrato', 'presupuesto')
            ->get();
        return response()->json($results);
    }

    public function datos($id)
    {
        $data = Siroc::select('clientes.razon_social', 'sirocs.folio')
            ->join('clientes', 'clientes.id', '=', 'sirocs.cliente_id')
            ->where('sirocs.folio', $id)->first();
        return response()->json($data);
    }
}
