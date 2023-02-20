<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodigoPostalStoreRequest;
use App\Http\Requests\CodigoPostalUpdateRequest;
use App\Imports\CodigosPostalesImport;
use App\Models\CodigoPostal;
use App\Models\Municipio;
use Illuminate\Http\Request;

/**
 * Class CodigoPostalController
 * @package App\Http\Controllers
 */
class CodigoPostalController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:codigos-postales.index')->only('index');
        $this->middleware('can:codigos-postales.store')->only('create', 'store');
        $this->middleware('can:codigos-postales.update')->only('edit', 'update');
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
        return view('Catalogos.codigo-postal.index', [
            'codigosPostales' => CodigoPostal::with(['municipio', 'estado'])
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    return $query->where('CP', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('municipio', 'nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('municipio.estado', 'nombre', 'LIKE', '%' . $request->buscar . '%');
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
        return view('Catalogos.codigo-postal.create', [
            'municipios' => Municipio::pluck('nombre', 'id'),
            'codigoPostal' => new CodigoPostal(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CodigoPostalStoreRequest $request)
    {
        $codigoPostal = CodigoPostal::create($request->all());
        return response()->json($codigoPostal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CodigoPostal $codigos_postale
     * @return \Illuminate\Http\Response
     */
    public function edit(CodigoPostal $codigos_postale)
    {
        return view('Catalogos.codigo-postal.edit', [
            'municipios' => Municipio::pluck('nombre', 'id'),
            'codigoPostal' => $codigos_postale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CodigoPostal $codigos_postale
     * @return \Illuminate\Http\Response
     */
    public function update(CodigoPostalUpdateRequest $request, CodigoPostal $codigos_postale)
    {
        $codigos_postale->update($request->all());
        return response()->json($codigos_postale);
    }

    public function import()
    {
        $import = new CodigosPostalesImport;
        $import->queue(request()->file('excel'));
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
            toastr('Los registros se agrego con exito.', 'warning');
        }
        toastr('El registro se agrego con exito.');
        return back();
    }

}
