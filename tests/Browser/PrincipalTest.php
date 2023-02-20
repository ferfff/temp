<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PrincipalTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testBannerStore()
    {
        $user = User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->assertAuthenticated()
                ->visit('/home')
                ->assertSee('Dashboard')
                ->clickLink('Home')
                ->clickLink('Banner')
                ->type('texto', 'prueba');
        });
    }
}
