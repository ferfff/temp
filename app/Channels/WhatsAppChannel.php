<?php
namespace App\Channels;

use App\Models\Parametro;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{

    protected $twilio;

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsApp($notifiable);

        $to = $notifiable->routeNotificationFor('WhatsApp');
        $from = config('services.twilio.whatsapp_from');

        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        if (Parametro::first()->medio == 'SMS') {
            return self::message("+521$to", "+1$from", $message->content);
        }

        return self::message("whatsapp:+521$to", "whatsapp:+1$from", $message->content);
    }

    protected function message($to, $from, $content)
    {
        return $this->twilio->messages->create($to, [
            "from" => $from,
            "body" => $content,
        ]);
    }
}
