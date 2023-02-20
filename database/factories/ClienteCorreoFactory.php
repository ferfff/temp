<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteCorreoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'titulo' => $this->faker->randomElement(['Lic.', 'Mtr.', 'Dr.', 'Ing.', 'Téc.']),
            'correo' => $this->faker->unique()->email,
            'tipo_correo' => $this->faker->randomElement(['Destinatario', 'CC', 'CCO']),
            'tipo_proceso' => $this->faker->randomElement(['Siroc', 'Alta Presupuesto', 'Autorizado Presupuesto', 'Estimacion', 'Jornal']),
            'cliente_id' => Cliente::inRandomOrder()->first()->id,
        ];
    }
}
