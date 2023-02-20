<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostVentaStoreRequest;
use App\Http\Requests\PostVentaUpdateRequest;
use App\Models\PostVenta;

/**
 * Class PostVentaController
 * @package App\Http\Controllers
 */
class PostVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Procesos.post-venta.index', [
            'postVentas' => PostVenta::with('contrato:id,folio')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Procesos.post-venta.create', [
            'postVenta' => new PostVenta(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostVentaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostVentaStoreRequest $request)
    {
        PostVenta::create([
            'nombre' => $request->nombre,
            'contrato_id' => $request->contrato_id,
            'monto' => $request->monto,
            'fecha_recepcion' => $request->fecha_recepcion,
            'archivo' => '/docs/postventas/' . $request->contrato_id . '/' . $request->archivo->getClientOriginalName(),
            'estado' => 0,
        ]);
        $request->archivo->move(public_path() . '/docs/postventas/' . $request->cliente_id . '/', $request->archivo->getClientOriginalName());

        toastr('El registro se agrego con exito.');
        return redirect()->route('post-ventas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PostVenta $postVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(PostVenta $postVenta)
    {
        return view('Procesos.post-venta.edit', [
            'postVenta' => $postVenta,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostVentaUpdateRequest $request
     * @param  PostVenta $postVenta
     * @return \Illuminate\Http\Response
     */
    public function update(PostVentaUpdateRequest $request, PostVenta $postVenta)
    {
        $postVenta->update([
            'nombre' => $request->nombre,
            'contrato_id' => $request->contrato_id,
            'monto' => $request->monto,
            'fecha_recepcion' => $request->fecha_recepcion,
            'estado' => $request->estado,
        ]);
        toastr('El registro se modifico con exito.');
        return redirect()->route('post-ventas.index');
    }
}
