<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Presupuesto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siroc>
 */
class SirocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uid' => Str::uuid(),
            'folio' => $this->faker->unique()->uuid,
            'descripcion' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'cliente_id' => Cliente::inRandomOrder()->first()->id,
            'presupuesto_id' => Presupuesto::inRandomOrder()->first()->id,
            'imss' => $this->faker->ean8,
            'archivo' => $this->faker->url(),
            'fecha_firma' => $this->faker->date('Y-m-d'),
            'fecha_cierre_siroc' => $this->faker->date('Y-m-d'),
        ];
    }
}
