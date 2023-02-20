<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presupuesto>
 */
class PresupuestoFactory extends Factory
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
            'monto' => $this->faker->numberBetween(10000, 100000),
            'fecha_recepcion' => $this->faker->date('Y-m-d'),
            'archivo' => $this->faker->url(),
            'estado' => $this->faker->randomElement(['Espera', 'Aprobado', 'Rechazado']),
        ];
    }
}
