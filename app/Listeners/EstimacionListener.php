<?php

namespace App\Listeners;

use App\Events\EstimacionEvent;
use App\Mail\EstimacionMail;
use App\Models\Cliente;
use App\Models\ClienteCorreo;
use App\Models\Contrato;
use Illuminate\Support\Facades\Mail;

class EstimacionListener
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
    public function handle(EstimacionEvent $event)
    {
        $users = ClienteCorreo::where('cliente_id',
            Cliente::whereRelation('contratos', 'uid', $event->contrato)->first()->id)
            ->where('tipo_proceso', $event->proceso)
            ->get();

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
            Mail::to($to)->cc($cc)->bcc($cco)->send(new EstimacionMail($event->estimacion, Contrato::where('uid', $event->contrato)->first(), $nombres[0], $event->correo, $event->pdf));
        }
    }
}
