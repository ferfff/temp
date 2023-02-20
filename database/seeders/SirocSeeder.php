<?php

namespace Database\Seeders;

use App\Models\Siroc;
use Illuminate\Database\Seeder;

class SirocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siroc::factory(20)->create();
    }
}
