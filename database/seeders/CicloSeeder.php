<?php

namespace Database\Seeders;

use App\Models\Ciclo;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciclo::create([
            'id' => 1,
            'nombre' => 'Apertura',
        ]);
        Ciclo::create([
            'id' => 2,
            'nombre' => 'Transcurso',
        ]);

        Ciclo::create([
            'id' => 3,
            'nombre' => 'Cierre',
        ]);

    }
}
