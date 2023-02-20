<?php

namespace Database\Seeders;

use App\Models\Expediente;
use Illuminate\Database\Seeder;

class ExpedienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expediente::factory(150)->create();
    }
}
