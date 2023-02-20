<?php

namespace App\Http\Controllers;

use App\Exports\ControlObraExport;
use App\Exports\TempleteDefinicionControlObraExport;
use App\Http\Requests\ControlObraStoreRequest;
use App\Imports\ControlObraImport;
use App\Models\Contrato;
use App\Models\ControlObra;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class ControlObraController
 * @package App\Http\Controllers
 */
class ControlObraController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:control-de-obras.index')->only('index');
        $this->middleware('can:control-de-obras.store')->only('show', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Catalogos.control-obra.index', [
            'contratos' => Contrato::with(['municipio:id,nombre', 'estado:id,nombre', 'cliente:id,razon_social'])
                ->withCount('control')
                ->where('tipo', 1)
            //->doesntHave('estimaciones')
                ->paginate(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ControlObraStoreRequest $request)
    {
        $controlObra = null;
        $contrato = Contrato::where('uid', $request->contrato_id)->first();
        if (count((array) $request->clave) > 0 && count((array) $request->partida) > 0 && count((array) $request->unidad) > 0 && count((array) $request->cantidad) > 0 && count((array) $request->precio_unitario) > 0 && count((array) $request->codigo_grupo) > 0 && count((array) $request->grupo) > 0 && count((array) $request->importe) > 0) {
            for ($i = 0; $i < count($request->clave); $i++) {
                $hash = md5($request->clave[$i] . '-' . $request->partida[$i] . '-' . $request->unidad[$i] . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $request->cantidad[$i])) . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $request->precio_unitario[$i])) . '-' . $request->codigo_grupo[$i] . '-' . $request->grupo[$i] . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $request->importe[$i]) . '-' . $contrato->id));
                $clave = ControlObra::where('clave', $request->clave[$i])->first();
                $controlObra = $contrato->control()->updateOrCreate(['hash' => $hash], [
                    'clave' => $request->clave[$i],
                    'uuid' => $clave != null && $contrato->id == $request->contrato_id && $clave->codigo_grupo == $request->codigo_grupo[$i] ? $clave->uuid : Str::uuid(),
                    'hash' => $hash,
                    'partida' => $request->partida[$i],
                    'unidad' => $request->unidad[$i],
                    'cantidad' => floatval(preg_replace("/[^-0-9\.]/", "", $request->cantidad[$i])),
                    'precio_unitario' => floatval(preg_replace("/[^-0-9\.]/", "", $request->precio_unitario[$i])),
                    'codigo_grupo' => $request->codigo_grupo[$i],
                    'grupo' => $request->grupo[$i],
                    'importe' => floatval(preg_replace("/[^-0-9\.]/", "", $request->importe[$i])),
                ]);
            }
        }
        return response()->json($controlObra);
    }

    /**
     * Display the specified resource.
     *
     * @param  ControlObra $controlObra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Catalogos.control-obra.show', [
            'contrato' => Contrato::where('uid', $id)
                ->first(),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $control = ControlObra::where('id', $request->id)->first();
        $control->delete();
        return response()->json($control);
    }

    public function unidades(Request $request)
    {
        $results = UnidadMedida::where('unidad', 'LIKE', "%$request->search%")
            ->orderBy('unidad')
            ->get();
        return response()->json($results);
    }

    public function import(Request $request)
    {
        (new ControlObraImport)->import($request->file);
    }

    public function export(Request $request, $id)
    {
        return (new ControlObraExport)->forId($id)->forRango($request->rango)->forMin($request->menor)->forMax($request->mayor)->download('desjato.xlsx');
    }

    public function templete(Contrato $contrato)
    {
        return (new TempleteDefinicionControlObraExport)->forContrato($contrato)->download('control-obra: ' . $contrato->folio . '-' . $contrato->cliente->razon_social . '.xlsx');
    }

    public function estado(Request $request)
    {
        $contrato = Contrato::where('uid', $request->contrato_id)->first();
        $contrato->update([
            'estado_partidas' => $request->estado_partidas == 'on' ? 1 : 0,
        ]);
        return back();
    }

    public function contrato($id)
    {
        $contrato = ControlObra::orderBy('codigo_grupo')->orderBy('grupo')->orderBy('clave')
            ->whereIn('id', function ($query) {
                return $query->select(DB::raw('MAX(id)'))->from('control_obras')->whereNull('deleted_at')->groupBy('clave');
            })->whereRelation('contrato', 'uid', '=', $id);
        return datatables()->of($contrato)->toJson();
    }
}
