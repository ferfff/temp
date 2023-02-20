<?php

namespace Database\Seeders;

use App\Models\Estimacion;
use Illuminate\Database\Seeder;

class EstimacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estimacion::factory(150)->create();
    }
}
