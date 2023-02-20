<?php

namespace Database\Seeders;

use App\Models\BitacoraMovimiento;
use Illuminate\Database\Seeder;

class BitacoraMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BitacoraMovimiento::factory(500)->create();
    }
}
