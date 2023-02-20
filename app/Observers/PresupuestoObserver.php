<?php

namespace App\Observers;

use App\Events\PresupuestoEvent;
use App\Models\Cliente;
use App\Models\Presupuesto;

class PresupuestoObserver
{
    /**
     * Handle the Presupuesto "created" event.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return void
     */
    public function created(Presupuesto $presupuesto)
    {
        event(new PresupuestoEvent($presupuesto, Cliente::where('razon_social', request()->cliente_id)->withTrashed()->first()->id, 'Alta Presupuesto', 1));
    }

    /**
     * Handle the Presupuesto "updated" event.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return void
     */
    public function updated(Presupuesto $presupuesto)
    {
        $accion = 'Modificado';
        if (request()->estado != '') {
            $accion = request()->estado == 'true' ? 'Aprobado' : 'Rechazado';
        }
        if ($accion == 'Aprobado') {
            event(new PresupuestoEvent($presupuesto, request()->cliente, 'Autorizado Presupuesto', 3, request()->comentario));
        }
        if ($accion == 'Rechazado') {
            event(new PresupuestoEvent($presupuesto, request()->cliente, 'Rechazado Presupuesto', 6, request()->comentario));
        }
        if ($accion == 'Modificado') {
            event(new PresupuestoEvent($presupuesto, Cliente::where('razon_social', request()->cliente_id)->withTrashed()->first()->id, 'Modificado Presupuesto', 7));
        }
        $presupuesto->bitacora()->create([
            'comentario' => request()->comentario,
            'user' => Auth()->user()->fullname,
            'accion' => $accion,
        ]);
    }
}
