<?php

namespace Database\Seeders;

use App\Models\Jornal;
use Illuminate\Database\Seeder;

class JornalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jornal::factory(20)->create();
    }
}
