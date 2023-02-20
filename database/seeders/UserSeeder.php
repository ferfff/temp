<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'nano',
            'apellido_paterno' => 'Martinez',
            'apellido_materno' => 'Ramirez',
            'email' => 'bernardo.martinez@mustango.com.mx',
            'phone_number' => '4381231962',
            'password' => bcrypt('Ner52do10ca#'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Salvador',
            'apellido_paterno' => 'Nahon',
            'apellido_materno' => '',
            'email' => 'salvador.nahon@mustango.com.mx',
            'password' => bcrypt('Jabalin4'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Angela',
            'apellido_paterno' => 'Soto',
            'apellido_materno' => '',
            'email' => 'angelasoto@petreacapital.com',
            'password' => bcrypt('6ZWj9insRwY7a6e#'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Lidia',
            'apellido_paterno' => 'Becerra',
            'apellido_materno' => '',
            'email' => 'lidiabecerra@petreacapital.com',
            'password' => bcrypt('PPu8z5sBRrj66zX#'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Eduardo',
            'apellido_paterno' => 'Mendoza',
            'apellido_materno' => '',
            'email' => 'eduardomendoza@petreacapital.com',
            'password' => bcrypt('Eg6TXGdg4ipY7HQ$'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'María Concepción',
            'apellido_paterno' => 'Terán',
            'apellido_materno' => 'García',
            'email' => 'concepcionteran@petreacapital.com',
            'password' => bcrypt('FWmbVXJEGyejP9j#'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'María del Roció',
            'apellido_paterno' => 'Hernández',
            'apellido_materno' => 'Arrona',
            'email' => 'rociohernandez@petreacapital.com',
            'password' => bcrypt('3SgH48Ci!H7hjj93'),
        ])->assignRole('Administrador');

        /*User::factory(196)->create()->each(function ($user) {
    $user->assignRole(array_rand(['Administrador' => 'Administrador', 'Operador' => 'Operador']));
    });*/
    }
}
