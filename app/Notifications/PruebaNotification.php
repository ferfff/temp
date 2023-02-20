<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use App\Models\Whatsapp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PruebaNotification extends Notification
{
    use Queueable;

    public $whatsapp;

    public function __construct(Whatsapp $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {
        $company = config('app.name');

        return (new WhatsAppMessage)
            ->content("La empresa {$company} el dia {$this->whatsapp->created_at} le manda el siguiente mensaje: {$this->whatsapp->mensaje}");

    }
}
