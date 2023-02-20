<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        General::create([
            'dias_expediente_inicial' => 30,
            'dias_expediente_final' => 0,
        ]);
    }
}
