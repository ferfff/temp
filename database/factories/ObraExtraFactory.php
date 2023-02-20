<?php

namespace Database\Factories;

use App\Models\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ObraExtra>
 */
class ObraExtraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bitacora' => $this->faker->paragraph($nb = 15, $asText = false),
            'contrato_id' => $this->faker->numberBetween($min = 1, $max = Contrato::count()),
            'presupuesto' => $this->faker->numberBetween($min = 10000, $max = 90000),
            'monto_original' => $this->faker->numberBetween($min = 1000000, $max = 9000000),
        ];
    }
}
