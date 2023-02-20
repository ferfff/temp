<?php

namespace Database\Factories;

use App\Models\Condicion;
use App\Models\Contrato;
use App\Models\DefinicionDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expediente>
 */
class ExpedienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->domainWord,
            'extension' => $this->faker->randomElement(['jpg', 'docx', 'xlxs', 'pptx', 'pdf']),
            'ruta' => $this->faker->url(),
            'condicion_id' => $this->faker->numberBetween($min = 1, $max = Condicion::count()),
            'comentario' => $this->faker->paragraph($nb = 15, $asText = false),
            'documento_id' => $this->faker->numberBetween($min = 1, $max = DefinicionDocumento::count()),
            'contrato_id' => $this->faker->numberBetween($min = 1, $max = Contrato::count()),
        ];
    }
}
