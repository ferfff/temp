<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BitacoraMovimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model = $this->faker->randomElement(['App\\Models\\Expediente', 'App\\Models\\Presupuesto', 'App\\Models\\Siroc', 'App\\Models\\Estimacion']);
        return [
            'comentario' => $this->faker->paragraph(5),
            'user' => User::inRandomOrder()->first()->fullName,
            'accion' => $this->faker->randomElement(['Aprobado', 'Rechazado', 'Eliminado', 'Cambio']),
            'model_id' => $model::inRandomOrder()->first()->id,
            'model_type' => $model,
        ];
    }
}
