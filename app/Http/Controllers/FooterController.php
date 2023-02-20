<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterUpdateRequest;
use App\Models\FooterPagina;
use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:principal.index')->only('index');
        $this->middleware('can:principal.update')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.footer', [
            'footer' => FooterPagina::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FooterUpdateRequest $request, $id)
    {
        $footer = FooterPagina::first()->update($request->all());
        return response()->json($footer);
    }
}
