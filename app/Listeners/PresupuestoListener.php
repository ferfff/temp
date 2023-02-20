<?php

namespace App\Listeners;

use App\Events\PresupuestoEvent;
use App\Mail\PresupuestoMail;
use App\Models\ClienteCorreo;
use Illuminate\Support\Facades\Mail;

class PresupuestoListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PresupuestoEvent $event)
    {
        $users = ClienteCorreo::where('cliente_id', $event->cliente)->where('tipo_proceso', $event->proceso)->get();

        $to = [];
        $nombres = [];
        $cc = [];
        $cco = [];

        foreach ($users as $user) {
            if ($user->tipo_correo == 'Destinatario') {
                array_push($to, $user->correo);
                array_push($nombres, $user->nombre_completo);
            }
            if ($user->tipo_correo == 'CC') {
                array_push($cc, $user->correo);
            }
            if ($user->tipo_correo == 'CCO') {
                array_push($cco, $user->correo);
            }
        }
        if (count($to) > 0) {
            Mail::to($to)->cc($cc)->bcc($cco)->send(new PresupuestoMail($event->presupuesto, $nombres[0], $event->correo, $event->descripcion));
        }
    }
}
