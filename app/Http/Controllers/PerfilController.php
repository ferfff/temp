<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $perfil)
    {
        return view('Sistema.usuarios.perfil', [
            'usuario' => $perfil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, User $perfil)
    {
        $perfil->update([
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'phone_number' => $request->phone_number,
        ]);
        toastr('El registro se modifico con exito.');
        return back();
    }

    public function password(PerfilRequest $request, User $perfil)
    {
        if (!empty($request->password) && !password_verify($request->password, $perfil->password)) {
            toastr('La contraseña actual no coincide con la contraseña ingresada.', 'info');
            return back();
        }
        $perfil->update([
            'password' => !empty($request->password) ? bcrypt($request->new_password) : $perfil->password,
        ]);
        toastr('El contraseña se modifico con exito.');
        return back();

    }

    public function img(Request $request)
    {
        $request->file('file')->move('img/perfiles/' . Auth()->user()->id, $request->file('file')->getClientOriginalName());
        Auth()->user()->update(['image' => 'img/perfiles/' . Auth()->user()->id . '/' . $request->file('file')->getClientOriginalName()]);
        toastr('Se agrego la imagen con exito.');
    }
}
