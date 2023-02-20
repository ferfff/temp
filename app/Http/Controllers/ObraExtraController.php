<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObraExtraStoreRequest;
use App\Http\Requests\ObraExtraUpdateRequest;
use App\Models\Archivo;
use App\Models\Contrato;
use App\Models\ObraExtra;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ObrasExtraController
 * @package App\Http\Controllers
 */
class ObraExtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:obras-extras.index')->only('index');
        $this->middleware('can:obras-extras.store')->only('create', 'store');
        $this->middleware('can:obras-extras.update')->only('edit', 'update');
        $this->middleware('can:obras-extras.destroy')->only('destroy');
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
        return view('Procesos.obras-extra.index', [
            'contratos' => Contrato::contrato($request->buscar)->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObraExtraStoreRequest $request)
    {

        if (!isset($request->archivo)) {
            toastr('Agrega un Archivo.', 'warning');
            return back();
        }

        $obra = ObraExtra::create($request->all());
        foreach ($request->archivo as $file) {
            Archivo::create([
                'documento' => 'storage/' . $request->folio . '/solicitud' . '/' . $obra->id . '/' . $file->getClientOriginalName(),
                'obra_extra_id' => $obra->id,
            ]);
        }
        Storage::putFileAs('/public/' . $request->folio . '/solicitud' . '/' . $obra->id, $file, $file->getClientOriginalName());

        toastr('El registro se agrego con exito.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $contrato = Contrato::select('id', 'folio', 'cliente_id')
            ->with('cliente:id,razon_social')
            ->where('id', $id)->first();
        return view('Procesos.obras-extra.show', [
            'obrasExtras' => ObraExtra::with([
                'contrato:id,folio,cliente_id',
                'contratoCliente:razon_social',
                'archivos',
            ])->whereHas('contrato', function ($query) use ($request, $id) {
                $query->where('id', $id)
                    ->when(empty($request->buscar) == false, fn($query) => $query->where('folio', 'LIKE', '%' . $request->buscar . '%'))
                    ->when($request->activo == 2, fn($query) => $query->where('aprobacion', 1))
                    ->when($request->activo == 1, fn($query) => $query->where('aprobacion', 0));
            })->paginate(),
            'contrato' => $contrato,
            'cliente' => $contrato->cliente,
            'tipos' => Tipo::all(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObraExtraUpdateRequest $request, $id)
    {
        if (!isset($request->archivo)) {
            toastr('Agrega un Archivo.', 'warning');
            return back();
        }
        $obra = ObraExtra::findOrFail($request->id);
        $obra->update($request->all());

        foreach ($request->archivo as $file) {
            Archivo::create([
                'documento' => 'storage/' . $request->folio . '/solicitud' . '/' . $obra->id . '/' . $file->getClientOriginalName(),
                'obra_extra_id' => $obra->id,
            ]);
        }
        Storage::putFileAs('/public/' . $request->folio . '/solicitud' . '/' . $obra->id, $file, $file->getClientOriginalName());

        toastr('El registro se modifico con exito.');
        return back()->with('success', 'El registro se modifico con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        ObrasExtra::find($id)->delete();
        toastr('El registro se elimino con exito.');
        return back()->with('success', 'El registro se elimino con exito');
    }
}
