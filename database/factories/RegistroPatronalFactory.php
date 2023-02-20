<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistroPatronal>
 */
class RegistroPatronalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'razon_social' => $this->faker->unique()->name,
            'razon_comercial' => $this->faker->unique()->company,
            'RFC' => $this->faker->unique()->ean13,
            'registro_patronal_imss' => $this->faker->isbn13,
        ];
    }
}
