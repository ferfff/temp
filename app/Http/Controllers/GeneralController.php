<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:generales.index')->only('index');
        $this->middleware('can:generales.update')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sistema.general.index', ['general' => General::first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  General $generale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General $generale)
    {
        $generale->update($request->all());
        return response()->json($generale);
    }
}
