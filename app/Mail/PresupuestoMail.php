<?php

namespace App\Mail;

use App\Models\PlantillaCorreo;
use App\Models\Presupuesto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Presupuesto $presupuesto,
        private $nombre,
        private $correo,
        private $descripcion
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $descripcion = $this->descripcion == null ? $this->presupuesto->descripcion : $this->descripcion;
        $correo = str_replace(
            ['{@usuario}', '{@id}', '{@descripcion}'],
            [$this->nombre, $this->presupuesto->folio, $descripcion],
            PlantillaCorreo::where('id', $this->correo)->first()->correo
        );
        return $this->view('mails.mail', [
            'correo' => trim(html_entity_decode($correo)),
        ]);
    }
}
