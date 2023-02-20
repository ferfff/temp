<?php

namespace App\Mail;

use App\Models\Contrato;
use App\Models\Expediente;
use App\Models\PlantillaCorreo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpedienteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Expediente $expediente,
        private Contrato $contrato,
        private $nombre,
        private $correo
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
            [$this->nombre, $this->contrato->id, $this->expediente->comentario],
            PlantillaCorreo::where('id', $this->correo)->first()->correo
        );
        return $this->view('mails.mail', [
            'correo' => trim(html_entity_decode($correo)),
        ]);
    }
}
