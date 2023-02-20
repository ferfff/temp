<?php

namespace Database\Factories;

use App\Models\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostVenta>
 */
class PostVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'contrato_id' => Contrato::inRandomOrder()->first()->id,
            'monto' => $this->faker->numberBetween(10000, 100000),
            'fecha_recepcion' => $this->faker->date('Y-m-d'),
            'archivo' => $this->faker->url(),
            'estado' => $this->faker->randomElement([0, 1]),
        ];
    }
}
