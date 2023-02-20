<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FooterPagina;
use App\Models\ImgSlider;
use App\Models\Parametro;
use App\Models\SliderPrincipal;

class PrincipalController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('principal', [
            'sliders' => SliderPrincipal::select('texto')->where('activo', 1)->get(),
            'footer' => FooterPagina::select('aviso_privacidad', 'facebook_url as facebook', 'twitter_url as twitter', 'instagram_url as instagram')
                ->first(),
            'parametro' => Parametro::select('titulo', 'logotipo')->first(),
            'img' => ImgSlider::select('img')->first(),
        ]);
    }
}
