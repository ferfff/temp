<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')
                ->assertSee('Jornales')
                ->click('.start')
                ->waitForText('Proporcione sus datos de acceso')
                ->type('email', $user->email)
                ->type('password', 'Ner52do10ca')
                ->click('button[type="submit"]')
                ->assertAuthenticated()
                ->assertUrlIs(route('home'))
                ->assertSee('Dashboard');
        });

    }
}
