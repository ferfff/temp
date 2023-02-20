<?php

namespace Database\Seeders;

use App\Models\Condicion;
use Illuminate\Database\Seeder;

class CondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condicion::create(['nombre' => 'Aprobado']);
        Condicion::create(['nombre' => 'Rechazado']);
        Condicion::create(['nombre' => 'En Proceso']);
    }
}
