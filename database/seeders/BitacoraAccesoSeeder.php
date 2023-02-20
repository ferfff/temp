<?php

namespace Database\Seeders;

use App\Models\BitacoraAcceso;
use Illuminate\Database\Seeder;

class BitacoraAccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BitacoraAcceso::factory(1250)->create();
    }
}
