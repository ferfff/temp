<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefinicionDocumentoStoreRequest;
use App\Http\Requests\DefinicionDocumentoUpdateRequest;
use App\Models\Ciclo;
use App\Models\DefinicionDocumento;
use Illuminate\Http\Request;

/**
 * Class DefinicionDocumentoController
 * @package App\Http\Controllers
 */
class DefinicionDocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:definicion-documentos.index')->only('index');
        $this->middleware('can:definicion-documentos.store')->only('create', 'store');
        $this->middleware('can:definicion-documentos.update')->only('edit', 'update');
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
        return view('Catalogos.definicion-documento.index', [
            'definicionDocumentos' => DefinicionDocumento::select('id', 'nombre', 'slug', 'obligatorio', 'solicita_aprobacion',
                'solicita_comentario', 'ciclo_id', 'multiple', 'referencia', 'seguimiento', 'aplazamiento', 'deleted_at')
                ->when($request->activo == 2, fn($query) => $query->onlyTrashed())
                ->when($request->activo == 0, fn($query) => $query->withTrashed())
                ->when(empty($request->buscar) == false,
                    fn($query) => $query->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                        ->orWhereRelation('ciclo', 'nombre', 'LIKE', '%' . $request->buscar . '%')
                )
                ->orderBy('id')
                ->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Catalogos.definicion-documento.create', [
            'definicionDocumento' => new DefinicionDocumento(),
            'ciclo' => Ciclo::pluck('nombre', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DefinicionDocumentoStoreRequest $request)
    {
        $definicionDocumento = DefinicionDocumento::create($request->all());
        if ($request->activo != 1) {
            $definicionDocumento->delete();
        }
        return response()->json($definicionDocumento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DefinicionDocumento $definicion_documento
     * @return \Illuminate\Http\Response
     */
    public function edit(DefinicionDocumento $definicion_documento)
    {
        return view('Catalogos.definicion-documento.edit', [
            'definicionDocumento' => $definicion_documento,
            'ciclo' => Ciclo::pluck('nombre', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DefinicionDocumento $definicionDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(DefinicionDocumentoUpdateRequest $request, DefinicionDocumento $definicionDocumento)
    {
        $definicionDocumento->update($request->all());
        if ($request->activo != 1) {
            $definicionDocumento->delete();
        }
        return response()->json($definicionDocumento);
    }

    /**
     * @param DefinicionDocumento $definicion_documento
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, DefinicionDocumento $definicion_documento)
    {
        $definicion_documento->delete();
        toastr('El registro se elimino con exito.');
        return back();

    }

    public function restore(DefinicionDocumento $definicion_documento)
    {
        $definicion_documento->restore();
        toastr('El registro se restauro con exito.');
        return back();
    }
}
