<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Cliente;
use App\Models\ClienteCorreo;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:clientes.index')->only('index');
        $this->middleware('can:clientes.store')->only('create', 'store');
        $this->middleware('can:clientes.update')->only('edit', 'update');
        $this->middleware('can:clientes.destroy')->only('destroy');
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
        return view('Catalogos.cliente.index', [
            'clientes' => Cliente::when($request->activo == 2, fn($query) => $query->onlyTrashed())
                ->when($request->activo == 0, fn($query) => $query->withTrashed())
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    $valor = '%' . preg_replace('/[^A-Za-z0-9]/', '', $request->buscar) . '%';
                    return $query->where(function ($query) use ($valor, $request) {
                        $query->whereRaw("regexp_replace(razon_social, '[^A-Za-z0-9]','') LIKE ?", [$valor])
                            ->orWhere('RFC', 'LIKE', '%' . $request->buscar . '%')
                            ->orWhereRaw("regexp_replace(contacto, '[^A-Za-z0-9]','') LIKE ?", [$valor])
                            ->orWhere('registro_patronal', 'LIKE', '%' . $request->buscar . '%');
                    });
                })
                ->orderBy('id')
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
        return view('Catalogos.cliente.create', [
            'cliente' => new Cliente(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStoreRequest $request)
    {
        $cliente = null;
        DB::transaction(function () use ($request) {
            $cliente = Cliente::create($request->all());
            if (count((array) $request->nombre) > 0 && count((array) $request->correo) > 0 && count((array) $request->tipo_correo) > 0 && count((array) $request->tipo_proceso) > 0) {
                for ($i = 0; $i < count($request->nombre); $i++) {
                    $cliente->correos()->create([
                        'nombre' => $request->nombre[$i],
                        'titulo' => $request->titulo[$i],
                        'correo' => $request->correo[$i],
                        'tipo_correo' => $request->tipo_correo[$i],
                        'tipo_proceso' => $request->tipo_proceso[$i],
                    ]);
                }
            }

            if ($request->activo == "false") {
                $cliente->delete();
            }
        });
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Catalogos.cliente.edit', [
            'cliente' => Cliente::where('slug', $id)->with('correos')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        DB::transaction(function () use ($request, $cliente) {
            $cliente->update($request->all());
            $cliente->correos()->delete();
            if (count((array) $request->nombre) > 0 && count((array) $request->correo) > 0 && count((array) $request->tipo_correo) > 0 && count((array) $request->tipo_proceso) > 0) {
                for ($i = 0; $i < count($request->nombre); $i++) {
                    $cliente->correos()->create([
                        'titulo' => $request->titulo[$i],
                        'nombre' => $request->nombre[$i],
                        'correo' => $request->correo[$i],
                        'tipo_correo' => $request->tipo_correo[$i],
                        'tipo_proceso' => $request->tipo_proceso[$i],
                    ]);
                }
            }
        });
        return response()->json($cliente);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $slug)
    {
        Cliente::where('slug', $request->slug)->first()->delete();
        toastr('El registro se elimino con exito.');
        return redirect()->route('clientes.index');
    }

    public function restore(Request $request, $slug)
    {
        Cliente::onlyTrashed()->where('slug', $request->slug)->first()->restore();
        toastr('El registro se restauro con exito.');
        return redirect()->route('clientes.index');
    }

    public function correos($id)
    {
        $results = ClienteCorreo::where('cliente_id', $id)->get();
        return datatables()->of($results)->toJson();
    }

    public function uso($proceso)
    {
        $results = Parametro::when($proceso == 'Alta Presupuesto', fn($query) => $query->select('dominio_alta_presupuesto as dominio'))
            ->when($proceso == 'Siroc', fn($query) => $query->select('dominio_siroc as dominio'))
            ->when($proceso == 'Autorizado Presupuesto', fn($query) => $query->select('dominio_autorizado_presupuesto as dominio'))
            ->when($proceso == 'Rechazado Presupuesto', fn($query) => $query->select('dominio_rechazado_presupuesto as dominio'))
            ->when($proceso == 'Modificado Presupuesto', fn($query) => $query->select('dominio_modificado_presupuesto as dominio'))
            ->when($proceso == 'Jornal', fn($query) => $query->select('dominio_jornales as dominio'))
            ->when($proceso == 'Estimacion', fn($query) => $query->select('dominio_estimaciones as dominio'))
            ->first();
        return response()->json($results);
    }
}
