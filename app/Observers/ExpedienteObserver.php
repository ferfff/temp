<?php

namespace App\Observers;

use App\Events\ExpedienteEvent;
use App\Models\Contrato;
use App\Models\Expediente;

class ExpedienteObserver
{
    /**
     * Handle the Expediente "created" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function created(Expediente $expediente)
    {
        event(new ExpedienteEvent($expediente, Contrato::where('uid', request()->contrato_id)->first()->uid, 'Expediente', 8));
    }
}
