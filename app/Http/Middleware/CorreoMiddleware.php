<?php

namespace App\Http\Middleware;

use App\Models\Parametro;
use Closure;
use Illuminate\Http\Request;

class CorreoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $server = Parametro::select('email_smtp as host', 'email_cuenta as username', 'email_password as password', 'email_puerto as port')->first();
        if (isset($server)) {
            Parametro::setCustomerSMTP($server);
        } else {
            Parametro::setSMTP();
        }
        return $next($request);
    }
}
