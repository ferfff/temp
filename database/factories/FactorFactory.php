<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FactorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SDI' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'SD' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'salario' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'puntualidad' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'asistencia' => $this->faker->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
