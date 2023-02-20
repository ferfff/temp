<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\ClienteCorreo;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cliente::factory(100)->create();
        //ClienteCorreo::factory(250)->create();
        $cliente = Cliente::create([
            'razon_social' => 'Berna Martinez',
            'RFC' => 'MARB981211ASD',
            'contacto' => 'Berna',
            'registro_patronal' => 'Berna',
            'repse' => '12345',
            'presupuesto' => 1,
            'siroc' => 1,
            'expediente' => 0,
        ]);
        $cliente->correos()->saveMany([
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Alta Presupuesto',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Autorizado Presupuesto',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Rechazado Presupuesto',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Modificado Presupuesto',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Siroc',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Estimacion',
            ]),
            new ClienteCorreo([
                'nombre' => 'Berna Martinez',
                'titulo' => 'Ing.',
                'correo' => 'benano51@gmail.com',
                'tipo_correo' => 'Destinatario',
                'tipo_proceso' => 'Expediente',
            ]),
        ]);
    }
}
