<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoStoreRequest;
use App\Http\Requests\EstadoUpdateRequest;
use App\Imports\EstadosImport;
use App\Models\Estado;
use Illuminate\Http\Request;

/**
 * Class EstadoController
 * @package App\Http\Controllers
 */
class EstadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:estados.index')->only('index');
        $this->middleware('can:estados.store')->only('create', 'store');
        $this->middleware('can:estados.update')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->buscar)) {
            toastr('Se ha actualizado la información.', 'info');
        }
        return view('Catalogos.estado.index', [
            'estados' => Estado::when(empty($request->buscar) == false, function ($query) use ($request) {
                $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
            })
                ->orderBy('id')
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
        return view('Catalogos.estado.create', [
            'estado' => new Estado(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoStoreRequest $request)
    {
        $estado = Estado::create($request->all());
        return response()->json($estado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('Catalogos.estado.edit', [
            'estado' => Estado::where('slug', $slug)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Estado $estado
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoUpdateRequest $request, Estado $estado)
    {
        $estado->update($request->all());
        return response()->json($estado);
    }

    public function import()
    {
        $import = new EstadosImport;
        $import->import(request()->file('excel'));
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
            toastr('Los registros se agrego con exito.', 'warning');
        }
        toastr('El registro se agrego con exito.');
        return back();
    }
}
