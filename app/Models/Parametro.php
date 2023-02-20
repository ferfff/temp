<?php

namespace App\Models;

use Config;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parametro
 *
 * @property $id
 * @property $titulo
 * @property $email_smtp
 * @property $email_cuenta
 * @property $email_password
 * @property $email_ssl
 * @property $email_puerto
 * @property $email_notificaciones
 * @property $lic
 * @property $whatsapp_api_key
 * @property $whatsapp_account
 * @property $whatsapp_dias_valido
 * @property $host_app
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Parametro extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'logotipo',
        'icono',
        'email_smtp',
        'email_cuenta',
        'email_password',
        'email_ssl',
        'email_puerto',
        'email_notificaciones',
        'lic',
        'whatsapp_api_key',
        'whatsapp_api_secret',
        'whatsapp_account',
        'whatsapp_dias_valido',
        'sms_account',
        'medio',
        'host_app',
        'presupuesto',
        'siroc',
        'contrato',
        'iva',
        'dominio_alta_presupuesto',
        'dominio_modificado_presupuesto',
        'dominio_autorizado_presupuesto',
        'dominio_rechazado_presupuesto',
        'dominio_siroc',
        'dominio_jornales',
        'dominio_estimaciones',
        'dominio_estimaciones_cliente',
        'dominio_estimaciones_pendiente',
        'dominio_expedientes',
    ];

    public static function setCustomerSMTP($server)
    {
        Config::set("mail.mailers.custom_smtp", [
            'transport' => env('MAIL_MAILER', 'smtp'),
            'host' => $server->host,
            'port' => $server->port,
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => $server->username,
            'password' => $server->password,
            'from' => [
                'address' => $server->username,
                'name' => env('APP_NAME'),
            ],
        ]);
        //dd(Config::get('mail.mailers.custom_smtp'));
    }

    public static function setSMTP()
    {
        Config::set("mail.mailers.custom_smtp", Config::get('mail.mailers.smtp'));
    }

}
