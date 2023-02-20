<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\CodigoPostal;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrato>
 */
class ContratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model = $this->faker->randomElement(['App\\Models\\Presupuesto', 'App\\Models\\Siroc']);

        return [
            'uid' => Str::uuid(),
            'folio' => $this->faker->unique()->ean8,
            'cliente_id' => $this->faker->numberBetween(1, Cliente::count()),
            'fecha_firma' => $this->faker->date('Y-m-d'),
            'fecha_inicio' => $this->faker->date('Y-m-d'),
            'fecha_cierre_siroc' => $this->faker->date('Y-m-d'),
            'fecha_termino' => $this->faker->date('Y-m-d'),
            'monto_anticipo' => $this->faker->numberBetween(10000, 100000),
            'importe_contratado' => $this->faker->numberBetween(10000, 100000),
            'suministros' => $this->faker->numberBetween(10000, 100000),
            'total_contrato' => $this->faker->numberBetween(10000, 100000),
            'porcentaje_amortizacion_anticipo' => $this->faker->numberBetween(0, 10),
            'concepto_adenda' => $this->faker->paragraph(5),
            'descripcion_contrato' => $this->faker->paragraph(15),
            'licencia' => $this->faker->ean13,
            'calle' => $this->faker->streetName,
            'no_ext' => $this->faker->buildingNumber,
            'no_int' => $this->faker->buildingNumber,
            'colonia' => $this->faker->stateAbbr,
            'localidad' => $this->faker->city,
            'referencia' => $this->faker->address,
            'municipio_id' => $this->faker->numberBetween(1, Municipio::count()),
            'estado_id' => $this->faker->numberBetween(1, Estado::count()),
            'codigo_postal' => $this->faker->numberBetween(1, CodigoPostal::count()),
            'permite_deductivas' => $this->faker->randomElement([0, 1]),
            'model_id' => $model::inRandomOrder()->first()->id,
            'model_type' => $model,
            'deleted_at' => $this->faker->randomElement([null, Now()]),
        ];
    }
}
