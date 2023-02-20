<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioStoreRequest;
use App\Http\Requests\MunicipioUpdateRequest;
use App\Imports\MunicipiosImport;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Http\Request;

/**
 * Class MunicipioController
 * @package App\Http\Controllers
 */
class MunicipioController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:municipios.index')->only('index');
        $this->middleware('can:municipios.store')->only('create', 'store');
        $this->middleware('can:municipios.update')->only('edit', 'update');
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
        return view('Catalogos.municipio.index', [
            'municipios' => Municipio::with('estado:id,nombre')
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    return $query->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('estado', 'nombre', 'LIKE', '%' . $request->buscar . '%');
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
        return view('Catalogos.municipio.create', [
            'municipio' => new Municipio(),
            'estados' => Estado::pluck('nombre', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioStoreRequest $request)
    {
        $municipio = Municipio::create($request->all());
        return response()->json($municipio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipio $municipio)
    {
        return view('Catalogos.municipio.edit', [
            'municipio' => $municipio,
            'estados' => Estado::pluck('nombre', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipioUpdateRequest $request, Municipio $municipio)
    {
        $municipio->update($request->all());
        return response()->json($municipio);
    }

    public function import()
    {
        $import = new MunicipiosImport;
        $import->queue(request()->file('excel'));
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
            toastr('Los registros se agrego con exito.', 'warning');
        }
        toastr('Los registros se agrego con exito.');
        return back();
    }
}
