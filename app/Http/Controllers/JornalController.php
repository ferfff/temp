<?php

namespace App\Http\Controllers;

use App\Http\Requests\JornalRequest;
use App\Imports\JornalImport;
use App\Models\Jornal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class JornalController
 * @package App\Http\Controllers
 */
class JornalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Procesos.jornal.index', [
            'jornales' => Jornal::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Procesos.jornal.create', [
            'jornal' => new Jornal(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JornalRequest $request)
    {
        Jornal::create($request->all());
        toastr('El registro se agrego con exito.');
        return redirect()->route('jornales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Jornal $jornale
     * @return \Illuminate\Http\Response
     */
    public function show(Jornal $jornale)
    {
        return view('Procesos.jornal.show', [
            'jornal' => $jornale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jornal $jornale)
    {
        return view('Procesos.jornal.edit', [
            'jornal' => $jornale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Jornale $jornale
     * @return \Illuminate\Http\Response
     */
    public function update(JornalRequest $request, Jornal $jornale)
    {
        $jornale->update($request->all());
        toastr('El registro se modifico con exito.');
        return redirect()->route('jornales.index');
    }

    public function import()
    {
        Excel::import(new JornalImport, request()->file('excel'));
        toastr('El registro se agrego con exito.');
        return back();
    }
}
