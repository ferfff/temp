<?php

namespace App\Providers;

use App\Models\Parametro;
use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Model::preventLazyLoading(!$this->app->isProduction());

        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        $parametro = Parametro::first();
        if ($parametro->count()) {
            Config::set('adminlte.title_postfix', ' | ' . $parametro->titulo);

            Config::set('services.twilio.sid', $parametro->whatsapp_api_key);
            Config::set('services.twilio.token', $parametro->whatsapp_api_secret);
            Config::set('services.twilio.whatsapp_from', $parametro->medio == 'Whatsapp' ? $parametro->whatsapp_account : $parametro->sms_account);

            Config::set('app.url', $parametro->host_app);

            Config::set('mail.default', 'custom_smtp');
            Config::set('mail.mailers.custom_smtp.transport', 'smtp');
            Config::set('mail.mailers.custom_smtp.host', $parametro->email_smtp);
            Config::set('mail.mailers.custom_smtp.port', $parametro->email_puerto);
            Config::set('mail.mailers.custom_smtp.username', $parametro->email_cuenta);
            Config::set('mail.mailers.custom_smtp.password', $parametro->email_password);
            Config::set('mail.mailers.custom_smtp.encryption', $parametro->email_password);
            Config::set('mail.mailers.from.address', $parametro->email_cuenta);
            Config::set('mail.mailers.from.name', $parametro->titulo);
            Config::set('adminlte.logo_img', $parametro->icono);
        }

        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

    }
}
