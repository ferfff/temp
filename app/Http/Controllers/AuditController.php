<?php

namespace App\Http\Controllers;

use App\Models\Audit;

/**
 * Class AuditController
 * @package App\Http\Controllers
 */
class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:auditorias.index')->only('index');
        $this->middleware('can:auditorias.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Sistema.audit.index', [
            'audits' => Audit::with([
                'user:id,name',
            ])->paginate(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Sistema.audit.show', [
            'audit' => Audit::find($id),
        ]);
    }
}
