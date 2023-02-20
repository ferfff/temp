<?php

namespace App\Listeners;

use App\Models\BitacoraAcceso;
use Illuminate\Auth\Events\Login;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        BitacoraAcceso::create([
            'user_id' => $event->user->id,
        ]);
    }
}
