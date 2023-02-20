<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColoniaStoreRequest;
use App\Http\Requests\ColoniaUpdateRequest;
use App\Imports\ColoniasImport;
use App\Models\CodigoPostal;
use App\Models\Colonia;
use Illuminate\Http\Request;

/**
 * Class ColoniaController
 * @package App\Http\Controllers
 */
class ColoniaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:colonias.index')->only('index');
        $this->middleware('can:colonias.store')->only('create', 'store');
        $this->middleware('can:colonias.update')->only('edit', 'update');
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
        return view('Catalogos.colonia.index', [
            'colonias' => Colonia::with(['codigoPostal', 'municipio', 'estado'])
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    return $query->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhere('tipo_asentamiento', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('codigoPostal', 'CP', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('codigoPostal.municipio', 'nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('codigoPostal.municipio.estado', 'nombre', 'LIKE', '%' . $request->buscar . '%');
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
        return view('Catalogos.colonia.create', [
            'codigosPostales' => CodigoPostal::pluck('cp', 'id'),
            'colonia' => new Colonia(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColoniaStoreRequest $request)
    {
        $colonia = Colonia::create($request->all());
        return response()->json($colonia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   Colonia $colonia
     * @return \Illuminate\Http\Response
     */
    public function edit(Colonia $colonia)
    {
        return view('Catalogos.colonia.edit', [
            'codigosPostales' => CodigoPostal::pluck('cp', 'id'),
            'colonia' => $colonia,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Colonia $colonia
     * @return \Illuminate\Http\Response
     */
    public function update(ColoniaUpdateRequest $request, Colonia $colonia)
    {
        $colonia->update($request->all());
        return response()->json($colonia);
    }

    public function import()
    {
        $import = new ColoniasImport;
        $import->queue(request()->file('excel'));
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
            toastr('Los registros se agrego con exito.', 'warning');
        }
        toastr('El registro se agrego con exito.');
        return back();
    }
}
