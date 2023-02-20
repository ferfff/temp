<?php

namespace Database\Factories;

use App\Models\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estimacion>
 */
class EstimacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = 'America/Mexico_City');
        return [
            'fecha_facturacion' => $this->faker->date('Y-m-d'),
            'no_factura' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'monto' => $this->faker->numberBetween($min = 10000, $max = 900000),
            'fondo_garantia' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'monto_amortizacion' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'monto_deductivas' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'monto_aditivas' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'iva' => 16,
            'nota' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'contrato_id' => $this->faker->numberBetween($min = 1, $max = Contrato::count()),
            'estado' => $this->faker->randomElement(['Cobrada', 'Pendiente', 'Cancelada']),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
