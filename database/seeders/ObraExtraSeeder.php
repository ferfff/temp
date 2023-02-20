<?php

namespace Database\Seeders;

use App\Models\ObraExtra;
use Illuminate\Database\Seeder;

class ObraExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObraExtra::factory(100)->create();
    }
}
