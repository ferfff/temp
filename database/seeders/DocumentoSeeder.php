<?php

namespace Database\Seeders;

use App\Models\DefinicionDocumento;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefinicionDocumento::create([
            'nombre' => 'Presupuesto',
            'obligatorio' => 1,
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 1,
            'seguimiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Alta Siroc',
            'obligatorio' => 1,
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 1,
            'aplazamiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Contrato',
            'obligatorio' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 1,
            'seguimiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Adendum',
            'solicita_aprobacion' => 1,
            'ciclo_id' => 1,
            'multiple' => 1,
            'seguimiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Fianza',
            'obligatorio' => 1,
            'ciclo_id' => 3,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Acta de Recepción',
            'obligatorio' => 1,
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 3,
            'seguimiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'FE DE ERRATAS',
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 1,
            'multiple' => 1,
            'seguimiento' => 1,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Cierre Siroc',
            'obligatorio' => 1,
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 3,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Recuperación de Fondos',
            'obligatorio' => 1,
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 3,
        ]);
        DefinicionDocumento::create([
            'nombre' => 'Contingencia Siroc',
            'solicita_aprobacion' => 1,
            'solicita_comentario' => 1,
            'ciclo_id' => 2,
        ]);

    }
}
