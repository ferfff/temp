<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::factory(1)->make()->first();

        //$role = Role::findByName('Administrador');
        //$role->users()->attach($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Sistema')
                ->clickLink('Usuarios')
                ->assertSee('Usuarios')
                ->assertUrlIs(route('usuarios.index'))
                ->click('button[type="button"]')
                ->waitForText('Agregar Usuario')
                ->type('name', $user->name)
                ->type('email', $user->email)
                ->type('password', $user->password)
                ->check(".rol")
                ->click('button[type="submit"]');
        });
    }

    public function testUpdate()
    {
        $user = User::find(1);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Sistema')
                ->clickLink('Usuarios')
                ->waitForText('Usuarios')
                ->assertUrlIs(route('usuarios.index'))
                ->click('#dropdownMenuButton')
                ->clickLink('Editar')
                ->assertUrlIs(route('usuarios.edit', $user->id))
                ->assertSee('Editar Usuario')
                ->type('password', 'Ner52do10ca')
                ->click('.btn');
        });
    }

    public function testDestroy()
    {
        $user = User::find(1);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Sistema')
                ->clickLink('Usuarios')
                ->waitForText('Usuarios')
                ->assertUrlIs(route('usuarios.index'))
                ->click('#dropdownMenuButton')
                ->clickLink('Eliminar')
                ->waitForText('Eliminar')
                ->click('.danger');
        });
    }
}
