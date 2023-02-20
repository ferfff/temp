<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlantillaCorreo;
use Illuminate\Http\Request;

class PlantillaCorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('sistema.inbox.plantilla.index', [
            'correos' => PlantillaCorreo::select('id', 'nombre')->orderBy('nombre')->get(),
            'img' => PlantillaCorreo::first()->img,
            'selected' => $request->correo,
        ]);
    }

    public function update(Request $request)
    {
        $plantilla = PlantillaCorreo::where('id', $request->id)->first();
        $plantilla->update([
            'correo' => htmlentities($request->plantilla),
        ]);
        return response()->json($plantilla);
    }

    public function img(Request $request)
    {
        $plantilla = PlantillaCorreo::first();
        $plantilla->update(['img' => 'img/correo/' . $request->file('file')->getClientOriginalName()]);
        $request->file('file')->move('img/correo', $request->file('file')->getClientOriginalName());
        toastr('Se agrego la imagen con exito.');
    }

    public function plantilla($id)
    {
        return PlantillaCorreo::where('id', $id)->first();
    }
}
