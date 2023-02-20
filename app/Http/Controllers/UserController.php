<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\BitacoraAcceso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:usuarios.index')->only('index');
        $this->middleware('can:usuarios.store')->only('store');
        $this->middleware('can:usuarios.update')->only('edit', 'update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->buscar) || isset($request->activo)) {
            toastr('Se ha actualizado la información.', 'info');
        }
        return view('Sistema.usuarios.index', [
            'usuarios' => User::when($request->activo == 2, fn($query) => $query->onlyTrashed())
                ->when($request->activo == 0, fn($query) => $query->withTrashed())
                ->when(empty($request->buscar) == null, function ($query) use ($request) {
                    return $query->where('name', 'LIKE', '%' . $request->buscar . '%');
                })
                ->with('roles:name')->paginate(),
            'roles' => Role::select('id', 'name')->get(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.usuarios.create', [
            'usuario' => new User(),
            'roles' => Role::select('id', 'name')->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        if ($request->password != $request->confirmed) {
            toastr('Las contraseñas no coinciden.', 'info');
            return back();
        }
        $user = null;
        DB::transaction(function () use ($request, $user) {
            $user = User::create([
                'name' => $request->name,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->roles()->sync($request->roles);
        });
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('sistema.usuarios.edit', [
            'usuario' => $usuario->load('roles:id'),
            'roles' => Role::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $usuario)
    {
        DB::transaction(function () use ($request, $usuario) {
            $usuario->update($request->all());
            $usuario->roles()->sync($request->roles);
        });
        return response()->json($usuario);
    }

    public function cambiarPassword(Request $request)
    {
        $usuario = User::where('id', $request->id)->first();
        $usuario->update([
            'password' => bcrypt($request->new_password),
        ]);
        toastr('El registro se modifico con exito.');
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        User::where('slug', $request->slug)->first()->delete();
        toastr('El registro se elimino con exito.');
        return redirect()->route('usuarios.index');
    }

    public function restore(Request $request, $slug)
    {
        User::onlyTrashed()->where('slug', $request->slug)->first()->restore();
        toastr('El registro se restauro con exito.');
        return back();
    }

    public function accesos($id)
    {
        $results = BitacoraAcceso::with('user:id,name,apellido_paterno,apellido_materno')
            ->whereRelation('user', 'id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return datatables()->of($results)->toJson();
    }
}
