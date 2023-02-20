<?php

namespace Database\Factories;

use App\Models\RegistroPatronal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obra>
 */
class ObraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'registro_patronal_id' => $this->faker->numberBetween(1, RegistroPatronal::count()),
            'clave_obra' => $this->faker->uuid,
            'nombre' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'etapa' => $this->faker->numberBetween($min = 1, $max = 5),
            'residente' => $this->faker->name(),
            'presupuesto' => $this->faker->numberBetween($min = 10000, $max = 1000000),
            'direccion' => $this->faker->address(),
            'fecha_inicio' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = 'America/Mexico_City'),
            'fecha_termino' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+10 years', $timezone = 'America/Mexico_City'),
        ];
    }
}
