<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObraStoreRequest;
use App\Http\Requests\ObraUpdateRequest;
use App\Models\Obra;
use App\Models\RegistroPatronal;
use Illuminate\Http\Request;

/**
 * Class ObraController
 * @package App\Http\Controllers
 */
class ObraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:obras.index')->only('index');
        $this->middleware('can:obras.store')->only('create', 'store');
        $this->middleware('can:obras.update')->only('edit', 'update');
        $this->middleware('can:obras.destroy')->only('destroy');
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
        return view('Catalogos.obra.index', [
            'obras' => Obra::select('id', 'registro_patronal_id', 'slug', 'clave_obra', 'nombre')
                ->with('registroPatronal:id,razon_social')
                ->when(empty($request->buscar) == false, function ($query) use ($request) {
                    $valor = '%' . preg_replace('/[^A-Za-z0-9]/', '', $request->buscar) . '%';
                    return $query->where('clave_obra', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereHas('registroPatronal', function ($query) use ($valor) {
                            $query->whereRaw("regexp_replace(razon_social, '[^A-Za-z0-9]','') LIKE ?", [$valor]);
                        });
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
        return view('Catalogos.obra.create', [
            'obra' => new Obra(),
            'registros_patronales' => RegistroPatronal::pluck('razon_social', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObraStoreRequest $request)
    {
        Obra::create($request->all());
        toastr('El registro se agrego con exito.');
        return redirect()->route('obras.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        return view('Catalogos.obra.edit', [
            'obra' => $obra,
            'registros_patronales' => RegistroPatronal::pluck('razon_social', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function update(ObraUpdateRequest $request, Obra $obra)
    {
        $obra->update($request->all());
        toastr('El registro se modifico con exito.');
        return redirect()->route('obras.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($slug)
    {
        Obra::where('slug', $slug)->first()->delete();
        toastr('El registro se elimino con exito.');
        return back();

    }
}
