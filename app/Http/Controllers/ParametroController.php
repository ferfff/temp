<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametroRequest;
use App\Models\DefinicionDocumento;
use App\Models\Parametro;
use Illuminate\Http\Request;

/**
 * Class ParametroController
 * @package App\Http\Controllers
 */
class ParametroController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:parametros.index')->only('index');
        $this->middleware('can:parametros.update')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Sistema.parametro.index', [
            'parametro' => Parametro::first(),
            'documentos' => DefinicionDocumento::pluck('nombre', 'nombre'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Parametro $parametro
     * @return \Illuminate\Http\Response
     */
    public function update(ParametroRequest $request, Parametro $parametro)
    {
        $saved = $parametro->update($request->all());
        return response()->json($saved);
    }

    public function icono(Parametro $parametro, Request $request)
    {
        $request->icono->move('favicons/', $request->icono->getClientOriginalName());
        $parametro->update([
            'icono' => 'favicons/' . $request->icono->getClientOriginalName(),
        ]);
        toastr('El registro se modifico con exito.');
        return redirect()->route('parametros.index');

    }

    public function logotipo(Parametro $parametro, Request $request)
    {
        $request->logotipo->move('img/', $request->logotipo->getClientOriginalName());
        $parametro->update([
            'logotipo' => 'img/' . $request->logotipo->getClientOriginalName(),
        ]);
        toastr('El registro se modifico con exito.');
        return redirect()->route('parametros.index');
    }
}
