<?php

namespace App\Http\Controllers;

use App\Http\Requests\SirocStoreRequest;
use App\Http\Requests\SirocUpdateRequest;
use App\Models\BitacoraMovimiento;
use App\Models\Cliente;
use App\Models\Presupuesto;
use App\Models\Siroc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class SirocController
 * @package App\Http\Controllers
 */
class SirocController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:sirocs.index')->only('index');
        $this->middleware('can:sirocs.store')->only('create', 'store');
        $this->middleware('can:sirocs.update')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('catalogos.siroc.index', [
            'sirocs' => Siroc::with([
                'cliente:id,razon_social',
                'presupuesto:id',
                'contrato:model_id,model_type',
            ])
                ->when(empty($request->buscar) == null, fn($query) =>
                    $query->where('folio', 'LIKE', "$request->buscar%")
                        ->orWhereRelation('cliente', 'razon_social', 'LIKE', "%$request->buscar%")
                )
                ->paginate(),
            'buscar' => $request->buscar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogos.siroc.create', [
            'siroc' => new Siroc(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SirocStoreRequest $request)
    {
        $siroc = null;
        $uid = uniqid();
        $time = time();
        DB::transaction(function () use ($request, $siroc, $uid, $time) {
            $siroc = Siroc::create([
                'folio' => $request->folio,
                'descripcion' => $request->descripcion,
                'cliente_id' => $request->cliente_id,
                'presupuesto_id' => $request->presupuesto_id,
                'imss' => $request->imss,
                'archivo' => '/docs/sirocs/' . $request->cliente_id . '/' . $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName(),
                'fecha_firma' => $request->fecha_firma,
                'fecha_cierre_siroc' => $request->fecha_cierre_siroc,
            ]);
            $request->archivo->move(public_path() . '/docs/sirocs/' . $request->cliente_id . '/', $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName());
        });
        return response()->json($siroc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siroc $siroc)
    {
        return view('catalogos.siroc.edit', [
            'siroc' => $siroc->load(['bitacora', 'presupuesto']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Siroc $siroc
     * @return \Illuminate\Http\Response
     */
    public function update(SirocUpdateRequest $request, Siroc $siroc)
    {
        $uid = uniqid();
        $time = time();
        DB::transaction(function () use ($request, $siroc, $uid, $time) {
            $siroc->update([
                'folio' => $request->folio,
                'descripcion' => $request->descripcion,
                'cliente_id' => $request->cliente_id,
                'presupuesto_id' => $request->presupuesto_id,
                'imss' => $request->imss,
                'archivo' => $request->archivo != 'undefined' ? '/docs/sirocs/' . $request->cliente_id . '/' . $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName() : $siroc->archivo,
                'fecha_firma' => $request->fecha_firma,
                'fecha_cierre_siroc' => $request->fecha_cierre_siroc,
            ]);
            if ($request->archivo != 'undefined') {
                $request->archivo->move(public_path() . '/docs/sirocs/' . $request->cliente_id . '/', $uid . '_' . $time . '_' . $request->archivo->getClientOriginalName());
            }
        });
        return response()->json($siroc);
    }

    public function bitacora($id)
    {
        $results = BitacoraMovimiento::whereHasMorph(
            'model',
            Siroc::class,
            fn($query) => $query->where('id', $id)
        )->get();
        return datatables()->of($results)->toJson();
    }

    public function clientes(Request $request)
    {
        $results = Cliente::select('id', 'razon_social', 'siroc')
            ->where('razon_social', 'LIKE', "%$request->search%")
            ->where('siroc', 1)
            ->distinct()
            ->limit(10)
            ->get();
        if (count($results) == 0) {
            $results = [['razon_social' => 'No se encontro ningun registro']];
        }
        return response()->json($results);
    }

    public function datos($id)
    {
        $data = Presupuesto::select('clientes.razon_social', 'presupuestos.folio')
            ->join('clientes', 'clientes.id', '=', 'presupuestos.cliente_id')
            ->where('presupuestos.folio', $id)->first();
        return response()->json($data);
    }

    public function presupuestos(Request $request)
    {
        $results = Presupuesto::select('id', 'folio')
            ->where('folio', 'LIKE', "%$request->term%")
            ->where('estado', 'Aprobado')
            ->with('contrato', 'siroc')
            ->get();
        return response()->json($results);
    }
}
