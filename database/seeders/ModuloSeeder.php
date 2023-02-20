<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::create(['name' => 'Home']);
        Modulo::create(['name' => 'Usuarios']);
        Modulo::create(['name' => 'Roles']);
        Modulo::create(['name' => 'Estados']);
        Modulo::create(['name' => 'Municipios']);
        Modulo::create(['name' => 'Codigos Postales']);
        Modulo::create(['name' => 'Colonias']);
        Modulo::create(['name' => 'Banner/Slider']);
        Modulo::create(['name' => 'Clientes']);
        Modulo::create(['name' => 'Definicion de documentos']);
        Modulo::create(['name' => 'Contratos']);
        Modulo::create(['name' => 'Expedientes']);
        Modulo::create(['name' => 'Estimaciones']);
        Modulo::create(['name' => 'Jornales']);
        Modulo::create(['name' => 'Obras Extras']);
        Modulo::create(['name' => 'Registros Patronales']);
        Modulo::create(['name' => 'Obras']);
        Modulo::create(['name' => 'Factores']);
        Modulo::create(['name' => 'Auditorias']);
        Modulo::create(['name' => 'Parametros']);
        Modulo::create(['name' => 'Configuracion General']);
        Modulo::create(['name' => 'Presupuesto']);
        Modulo::create(['name' => 'Siroc']);
        Modulo::create(['name' => 'Correo']);
        Modulo::create(['name' => 'Post Venta']);
        Modulo::create(['name' => 'Nota de Credito']);
        Modulo::create(['name' => 'Control de Obra']);
    }
}
