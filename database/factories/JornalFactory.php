<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jornal>
 */
class JornalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NSS' => $this->faker->ean8,
            'nombre_completo' => $this->faker->name,
            'departamento' => $this->faker->jobTitle,
            'curp' => $this->faker->isbn13,
            'dias_laborados' => $this->faker->numberBetween(1, 30),
            'SDI' => $this->faker->unique()->ean13,
        ];
    }
}
