<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'razon_social' => $this->faker->unique()->company,
            'RFC' => $this->faker->unique()->ean13,
            'contacto' => $this->faker->name,
            'registro_patronal' => $this->faker->unique()->isbn13,
            'repse' => $this->faker->ean8,
            'presupuesto' => $this->faker->randomElement([0, 1]),
            'siroc' => $this->faker->randomElement([0, 1]),
            'expediente' => $this->faker->randomElement([0, 1]),
            'deleted_at' => $this->faker->randomElement([null, Now()]),
        ];
    }
}
