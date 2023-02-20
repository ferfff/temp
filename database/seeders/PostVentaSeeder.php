<?php

namespace Database\Seeders;

use App\Models\PostVenta;
use Illuminate\Database\Seeder;

class PostVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostVenta::factory(20)->create();
    }
}
