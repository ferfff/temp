<?php

namespace App\Mail;

use App\Models\PlantillaCorreo;
use App\Models\Siroc;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SirocMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Siroc $siroc,
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
            [$this->nombre, $this->siroc->uid, $this->siroc->descripcion],
            PlantillaCorreo::where('id', $this->correo)->first()->correo
        );
        return $this->view('mails.mail', [
            'correo' => trim(html_entity_decode($correo)),
        ]);

    }
}
