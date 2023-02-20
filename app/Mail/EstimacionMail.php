<?php

namespace App\Mail;

use App\Models\Contrato;
use App\Models\Estimacion;
use App\Models\PlantillaCorreo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstimacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Estimacion $estimacion,
        private Contrato $contrato,
        private $nombre,
        private $correo,
        private $pdf = null
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $correo = str_replace(
            ['{@usuario}', '{@id}', '{@descripcion}'],
            [$this->nombre, $this->contrato->id, $this->estimacion->nota],
            PlantillaCorreo::where('id', $this->correo)->first()->correo
        );
        if ($this->pdf != null) {
            return $this->view('mails.mail', [
                'correo' => trim(html_entity_decode($correo)),
            ])->attach($this->pdf, [
                'as' => 'Estimacion.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        return $this->view('mails.mail', [
            'correo' => trim(html_entity_decode($correo)),
        ]);
    }
}
