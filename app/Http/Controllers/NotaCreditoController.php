<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotaCreditoRequest;
use App\Models\Cliente;
use App\Models\NotaCredito;
use Illuminate\Http\Request;

/**
 * Class NotaCreditoController
 * @package App\Http\Controllers
 */
class NotaCreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:nota-de-credito.index')->only('index');
        $this->middleware('can:nota-de-credito.store')->only('create', 'store');
        $this->middleware('can:nota-de-credito.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        list($inicio, $fin) = isset($request->daterange) ? array_map('trim', explode(" - ", $request->daterange)) : null;
        if (isset($request->daterange)) {
            toastr('Informacion actualizada', 'info');
        }
        return view('Procesos.nota-credito.index', [
            'notaCreditos' => NotaCredito::with('cliente:id,razon_social', 'estimacion:id,created_at')
                ->when($request->activo == 2, fn($query) => $query->doesntHave('estimacion'))
                ->when($request->activo == 1, fn($query) => $query->has('estimacion'))
                ->where(fn($query) => $query->when($request->activo == 0 || $request->activo == null, fn($query) => $query->has('estimacion')->orDoesntHave('estimacion')))
                ->when(empty($request->buscar) == null, fn($query) => $query->where('emisor', 'LIKE', "%$request->buscar%")
                        ->orWhereRelation('cliente', 'RFC', 'LIKE', "%$request->buscar%"))
                ->when(empty($request->daterange) == null, fn($query) => $query->whereBetween('fecha',
                    [date("Y-d-m", strtotime($inicio)), date("Y-d-m", strtotime($fin))]
                ))->paginate(),
            'buscar' => $request->buscar,
            'activo' => $request->activo,
            'datarange' => $request->daterange,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Procesos.nota-credito.create', [
            'notaCredito' => new NotaCredito(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotaCreditoRequest $request)
    {
        $uid = uniqid();
        $time = time();
        $notaCredito = NotaCredito::create([
            'emisor' => $request->emisor,
            'cliente_id' => $request->cliente_id,
            'folio' => $request->folio,
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'pdf' => '/docs/notas_de_credito/' . $request->cliente_id . '/' . $uid . '/' . $uid . '_' . $time . '_' . $request->pdf->getClientOriginalName(),
            'xml' => '/docs/notas_de_credito/' . $request->cliente_id . '/' . $uid . '/' . $uid . '_' . $time . '_' . $request->xml->getClientOriginalName(),
        ]);
        $request->pdf->move(public_path() . '/docs/notas_de_credito/' . $request->cliente_id . '/' . $uid, $uid . '_' . $time . '_' . $request->pdf->getClientOriginalName());
        $request->xml->move(public_path() . '/docs/notas_de_credito/' . $request->cliente_id . '/' . $uid, $uid . '_' . $time . '_' . $request->xml->getClientOriginalName());
        return response()->json($notaCredito);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notaCredito = NotaCredito::where('uuid', $id)->first();
        $notaCredito->delete();
        toastr('El registro se elimino con exito.');
        return back();
    }

    public function cliente($id)
    {
        return response()->json(Cliente::where('RFC', $id)->get());
    }
}
