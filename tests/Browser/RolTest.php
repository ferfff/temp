<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RolTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::factory(1)->make()->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Sistema')
                ->clickLink('Roles')
                ->assertSee('Roles')
                ->assertUrlIs(route('roles.index'))
                ->click('button[type="button"]')
                ->waitForText('Agregar Rol')
                ->type('name', 'rol de prueba')
                ->check(".rol")
                ->click('button[type="submit"]');
        });
    }

    public function testUpdate()
    {
        $user = User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Sistema')
                ->clickLink('Roles')
                ->assertSee('Roles')
                ->assertUrlIs(route('roles.index'))
                ->clickLink('Editar')
                ->waitForText('Editar Rol')
                ->click('button[type="submit"]');
        });
    }
}
