<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactorRequest;
use App\Models\Factor;
use App\Models\Factore;
use Illuminate\Http\Request;

/**
 * Class FactoreController
 * @package App\Http\Controllers
 */
class FactorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:factores.index')->only('index');
        $this->middleware('can:factores.store')->only('create', 'store');
        $this->middleware('can:factores.update')->only('edit', 'update');
        $this->middleware('can:factores.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($request->buscar)) {
            toastr('Se ha actualizado la información.', 'info');
        }
        return view('Catalogos.factor.index', [
            'factores' => Factor::select('id', 'SDI', 'SD', 'salario', 'puntualidad', 'asistencia')
                ->orderBy('id')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Catalogos.factor.create', [
            'factor' => new Factor(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactorRequest $request)
    {
        Factor::create($request->all());
        toastr('El registro se agrego con exito.');
        return redirect()->route('factores.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Factor $factore
     * @return \Illuminate\Http\Response
     */
    public function edit(Factor $factore)
    {
        return view('Catalogos.factor.edit', [
            'factor' => $factore,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Factor $factore
     * @return \Illuminate\Http\Response
     */
    public function update(FactorRequest $request, Factor $factore)
    {
        $factore->update($request->all());
        toastr('El registro se modifico con exito.');
        return redirect()->route('factores.index');
    }
}
