<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Estimacion;
use App\Models\Expediente;
use App\Models\Presupuesto;
use App\Models\Siroc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        $results = [];
        $estimaciones = Estimacion::with([
            'contrato:id,folio,cliente_id',
            'contrato.cliente:id,razon_social',
        ])->get();
        $events = [];
        foreach ($estimaciones as $estimacion) {
            $events[] = [
                'title' => $estimacion->contrato->cliente->razon_social . '/' . $estimacion->contrato->folio . ' no.' . $estimacion->no_estimacion,
                'start' => $estimacion->created_at,
            ];
        }
        if (isset($request->search)) {
            $results = Search::new ()
                ->add(Contrato::with('cliente'), ['cliente.razon_social', 'created_at'])
                ->add(Presupuesto::with('cliente'), ['cliente.razon_social', 'created_at'])
                ->add(Siroc::with('cliente'), ['cliente.razon_social', 'created_at'])
                ->beginWithWildcard()
                ->orderByModel([Contrato::class, Presupuesto::class, Siroc::class])
                ->search($request->search);
        }
        return view('dashboard', [
            'presupuestos_total' => Presupuesto::count(),
            'estimaciones' => Estimacion::where('estado', 'Pendiente')->count(),
            'expedientes_aprobacion' => Expediente::whereNotIn('condicion_id', [1])->count(),
            'expedientes_seguimiento' => Expediente::whereRelation('documento', 'seguimiento', 1)->whereDate('seguimiento', '>=', date('Y-m-d'))->count(),
            'presupuestos' => new LaravelChart([
                'chart_title' => 'Presupuestos',
                'report_type' => 'group_by_string',
                'model' => 'App\Models\Presupuesto',
                'group_by_field' => 'estado',
                'chart_type' => 'pie',
                'filter_field' => 'created_at',
                'filter_days' => 30,
            ]),
            'contratos' => Contrato::select('contratos.id', 'contratos.uid', 'contratos.folio', 'clientes.razon_social', 'contratos.descripcion_contrato', 'contratos.importe_contratado',
                'contratos.suministros', 'contratos.total_contrato', 'contratos.created_at', DB::raw("SUM(estimaciones.monto_facturar) as estimacion"), DB::raw('MAX(estimaciones.created_at) as reciente'),
                DB::raw("SUM(estimaciones.monto_facturar) / (contratos.importe_contratado-contratos.suministros) as avance"))
                ->join('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                ->leftJoin('estimaciones', 'contratos.id', '=', 'estimaciones.contrato_id')
                ->groupBy('contratos.id', 'contratos.uid', 'contratos.folio', 'clientes.razon_social', 'contratos.descripcion_contrato', 'contratos.importe_contratado', 'contratos.suministros', 'contratos.total_contrato', 'contratos.created_at')
                ->having('avance', '<', 1)
                ->orderBy('avance', 'desc')
                ->limit(10)->get(),
            'results' => $results,
            'search' => $request->search,
            'eventos' => $events,
        ]);
    }
}
