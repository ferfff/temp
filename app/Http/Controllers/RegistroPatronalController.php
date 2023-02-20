<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroPatronalStoreRequest;
use App\Http\Requests\RegistroPatronalUpdateRequest;
use App\Models\RegistroPatronal;
use App\Models\RegistrosPatronale;
use Illuminate\Http\Request;

/**
 * Class RegistrosPatronaleController
 * @package App\Http\Controllers
 */
class RegistroPatronalController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:registros-patronales.index')->only('index');
        $this->middleware('can:registros-patronales.store')->only('create', 'store');
        $this->middleware('can:registros-patronales.update')->only('edit', 'update');
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
        return view('Catalogos.registro-patronal.index', [
            'registrosPatronales' => RegistroPatronal::select('id', 'razon_social', 'slug', 'razon_comercial', 'RFC', 'registro_patronal_imss', 'logotipo')
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    $valor = '%' . preg_replace('/[^A-Za-z0-9]/', '', $request->buscar) . '%';
                    return $query->whereRaw("regexp_replace(razon_social, '[^A-Za-z0-9]','') LIKE ?", [$valor])
                        ->orWhereRaw("regexp_replace(razon_comercial, '[^A-Za-z0-9]','') LIKE ?", [$valor])
                        ->orWhere('RFC', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhere('registro_patronal_imss', 'LIKE', '%' . $request->buscar . '%');
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
        $registroPatronal = new RegistroPatronal();
        return view('Catalogos.registro-patronal.create', compact('registroPatronal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroPatronalStoreRequest $request)
    {
        RegistroPatronal::create([
            'razon_social' => $request->razon_social,
            'razon_comercial' => $request->razon_comercial,
            'RFC' => $request->RFC,
            'registro_patronal_imss' => $request->registro_patronal_imss,
            'logotipo' => 'logos/' . $request->razon_social . '/' . $request->logotipo->getClientOriginalName(),
        ]);
        $request->logotipo->move(public_path() . '/logos/' . $request->razon_social, $request->logotipo->getClientOriginalName());
        toastr('El registro se agrego con exito.');
        return redirect()->route('registros-patronales.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RegistroPatronal $registros_patronale
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroPatronal $registros_patronale)
    {
        return view('Catalogos.registro-patronal.edit', [
            'registroPatronal' => $registros_patronale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RegistrosPatronale $registros_patronale
     * @return \Illuminate\Http\Response
     */
    public function update(RegistroPatronalUpdateRequest $request, RegistroPatronal $registros_patronale)
    {
        $registros_patronale->update([
            'razon_social' => $request->razon_social,
            'razon_comercial' => $request->razon_comercial,
            'RFC' => $request->RFC,
            'registro_patronal_imss' => $request->registro_patronal_imss,
            'logotipo' => isset($request->logotipo) ? 'logos/' . $request->razon_social . '/' . $request->logotipo->getClientOriginalName() : $registros_patronale->logotipo,
        ]);
        if (isset($request->logotipo)) {
            $request->logotipo->move(public_path() . '/logos/' . $request->razon_social, $request->logotipo->getClientOriginalName());
        }

        toastr('El registro se modifico con exito.');
        return redirect()->route('registros-patronales.index');
    }

}
