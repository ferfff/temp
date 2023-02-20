<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Whatsapp;
use App\Notifications\PruebaNotification;
use Exception;
use Illuminate\Http\Request;
use Log;

class WhatsappController extends Controller
{
    /**
     * Send Message whatssap.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(Request $request)
    {
        $mensaje = null;
        try {
            $whatsapp = Whatsapp::create($request->all());

            $user = User::where('phone_number', $request->destino)->get();
            if ($user->count()) {
                $mensaje = $user->first()->notify(new PruebaNotification($whatsapp));

                toastr('El registro se agrego con exito.');
                return response()->json($mensaje);
            }
            toastr('Revise que el numero este registrado o este dado de alta.', 'warning');
            return response()->json($mensaje);
        } catch (Exception $e) {
            toastr('Error.', 'danger');
            return back();
        }
    }

    public function handle(Request $request)
    {
        Log::info($request);
    }
}
