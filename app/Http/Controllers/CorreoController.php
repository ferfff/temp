<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Prueba;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $server = Parametro::select('email_smtp as host', 'email_cuenta as username', 'email_password as password', 'email_puerto as port')->first();
        if (isset($server)) {
            Parametro::setCustomerSMTP($server);
        } else {
            Parametro::setSMTP();
        }
        $correo = Mail::mailer('custom_smtp')->to($request->correo)->send(new Prueba());

        return response()->json($correo);
    }
}
