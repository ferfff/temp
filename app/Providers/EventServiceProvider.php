<?php

namespace App\Providers;

use App\Events\EstimacionEvent;
use App\Events\ExpedienteEvent;
use App\Events\PresupuestoEvent;
use App\Events\SirocEvent;
use App\Listeners\EstimacionListener;
use App\Listeners\ExpedienteListener;
use App\Listeners\PresupuestoListener;
use App\Listeners\SirocListener;
use App\Listeners\SuccessfulLogin;
use App\Models\Expediente;
use App\Models\Presupuesto;
use App\Models\Siroc;
use App\Observers\ExpedienteObserver;
use App\Observers\PresupuestoObserver;
use App\Observers\SirocObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            SuccessfulLogin::class,
        ],
        PresupuestoEvent::class => [
            PresupuestoListener::class,
        ],
        SirocEvent::class => [
            SirocListener::class,
        ],
        ExpedienteEvent::class => [
            ExpedienteListener::class,
        ],
        EstimacionEvent::class => [
            EstimacionListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Presupuesto::observe(PresupuestoObserver::class);
        Siroc::observe(SirocObserver::class);
        Expediente::observe(ExpedienteObserver::class);
    }
}
