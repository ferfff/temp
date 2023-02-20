<?php

namespace App\Observers;

use App\Events\SirocEvent;
use App\Models\Cliente;
use App\Models\Siroc;

class SirocObserver
{

    /**
     * Handle the Siroc "created" event.
     *
     * @param  \App\Models\Siroc  $siroc
     * @return void
     */
    public function created(Siroc $siroc)
    {
        event(new SirocEvent($siroc, Cliente::where('razon_social', request()->cliente_id)->withTrashed()->first()->id, 'Siroc', 2));
    }

    /**
     * Handle the Siroc "updated" event.
     *
     * @param  \App\Models\Siroc  $siroc
     * @return void
     */
    public function updated(Siroc $siroc)
    {
        $siroc->bitacora()->create([
            'comentario' => request()->comentario,
            'user' => Auth()->user()->fullname,
            'accion' => 'Cambio',
        ]);
    }
}
