<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Datos Base
        $this->call([
            ParametroSeeder::class,
            PlantillaCorreoSeeder::class,
            GeneralSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            CodigoPostalSeeder::class,
            ColoniaSeeder::class,
            ModuloSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PrincipalSeeder::class,
            CicloSeeder::class,
            DocumentoSeeder::class,
            TipoSeeder::class,
            CondicionSeeder::class,
        ]);

        // Pruebas
        $this->call([
            ClienteSeeder::class,
            /*PresupuestoSeeder::class,
        SirocSeeder::class,
        ContratoSeeder::class,
        RegistroPatronalSeeder::class,
        ObraSeeder::class,
        FactorSeeder::class,
        EstimacionSeeder::class,
        ObraExtraSeeder::class,
        ExpedienteSeeder::class,
        BitacoraMovimientoSeeder::class,
        BitacoraAccesoSeeder::class,
        JornalSeeder::class,
        PostVentaSeeder::class,*/
        ]);
    }
}
