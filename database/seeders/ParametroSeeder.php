<?php

namespace Database\Seeders;

use App\Models\Parametro;
use Illuminate\Database\Seeder;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametro::create([
            'titulo' => 'Jornales DB',
            'email_smtp' => 'smtp.ionos.mx',
            'email_cuenta' => 'noreplay@redmayoreo.com',
            'email_password' => 'Red##Mayoreo##2021',
            'email_ssl' => 0,
            'email_puerto' => 587,
            'email_notificaciones' => 'e',
            'lic' => 'f',
            'whatsapp_api_key' => 'AC7ef7e61186716a58a5f6f9c11edd0bf7',
            'whatsapp_api_secret' => '6749555f2d14508264da4736f362b889',
            'whatsapp_account' => '4155238886',
            'sms_account' => '5206360584',
            'medio' => 'Whatsapp',
            'whatsapp_dias_valido' => 30,
            'host_app' => 'http://jornales.local',
            'presupuesto' => 'Presupuesto',
            'siroc' => 'Alta Siroc',
        ]);
    }
}
