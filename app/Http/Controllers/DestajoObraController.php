<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestajoObraRequest;
use App\Models\Contrato;
use App\Models\ControlObra;
use App\Models\DestajoObra;
use App\Models\EvidenciaControlObra;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DestajoObraController
 * @package App\Http\Controllers
 */
class DestajoObraController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:destajo-de-obras.store')->only('show', 'store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestajoObraRequest $request)
    {
        $control = [];
        $iva = Parametro::select('iva')->first()->iva / 100;
        DB::transaction(function () use ($request, $control, $iva, $estimacion) {
            for ($i = 0; $i < count((array) $request->control_id); $i++) {
                $importe = !is_null($request->importe[$i]) ? floatval(preg_replace("/[^-0-9\.]/", "", $request->importe[$i])) : 0;
                $control[] = DestajoObra::create([
                    'control_id' => $request->control_id[$i],
                    'cantidad' => !is_null($request->cantidad[$i]) ? floatval(preg_replace("/[^-0-9\.]/", "", $request->cantidad[$i])) : 0,
                    'importe' => $importe,
                    'importe_iva' => $importe + ($importe * $iva),
                    'estimacion' => $estimacion + 1,
                ]);
            }
        });
        return response()->json($control);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::with([
            'control' => fn($query) => $query
                ->with([
                    'definiciones' => fn($query) => $query->select('control_obras.id', 'control_obras.uuid', 'destajo.control_id',
                        DB::raw('SUM(destajo.cantidad) as cantidad_acumulada'), DB::raw('SUM(destajo.importe) as importe_acumulado'))
                        ->groupBy('control_obras.id', 'control_obras.uuid', 'destajo.control_id')
                        ->join('destajo_obras as destajo', 'control_obras.id', '=', 'destajo.control_id')
                        ->withCount('destajos'),
                ])
                ->orderBy('codigo_grupo')
                ->orderBy('grupo')
                ->orderBy('clave')
                ->whereIn('control_obras.id', function ($query) {
                    return $query->select(DB::raw('MAX(control_obras.id)'))->from('control_obras')->whereNull('deleted_at')->groupBy('clave');
                }),
        ])
            ->where('uid', $id)
            ->first();
        $keys = [];
        $codigo = [];
        foreach ($contrato->control as $grupo) {
            if (!in_array($grupo->grupo, $keys)) {
                $keys[] = $grupo->grupo;
                $codigo[] = $grupo->codigo_grupo;
            }
        }
        return view('Catalogos.destajo-obra.show', [
            'contrato' => $contrato,
            'keys' => $keys,
            'codigos' => $codigo,
            'iva' => Parametro::select('iva')->first()->iva / 100,
            'estimacion' => ControlObra::withMax('destajos', 'estimacion')
                ->whereRelation('contrato', 'uid', $contrato->uid)->first()->destajos_max_estimacion + 1 ?? 1,
        ]);
    }

    public function evidencia(Request $request)
    {
        $control = ControlObra::where('id', $request->control_id)->first();
        $uid = uniqid();
        $time = time();

        $control->evidencias()->create([
            'foto' => '/docs/evidencias_destajos/' . $request->control_id . '/' . $uid . '_' . $time . '_' . $request->file->getClientOriginalName(),
            'comentario' => $request->comentario,
        ]);
        $request->file->move(public_path() . '/docs/evidencias_destajos/' . $request->control_id, $uid . '_' . $time . '_' . $request->file->getClientOriginalName());
    }

    public function definiciones(Request $request)
    {
        $control = ControlObra::select('id')->where('uuid', $request->id)->pluck('id');
        $evidencia = EvidenciaControlObra::whereIn('control_id', $control)->get();
        return datatables()->of($evidencia)->toJson();
    }
}
