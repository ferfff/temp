<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerStoreRequest;
use App\Models\ImgSlider;
use App\Models\SliderPrincipal;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:principal.index')->only('index');
        $this->middleware('can:principal.store')->only('img', 'store');
        $this->middleware('can:principal.update')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.banner', [
            'banner' => SliderPrincipal::select('id', 'texto', 'activo', 'created_at')->paginate(5),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        $slider = SliderPrincipal::create([
            'texto' => $request->texto,
            'user_id' => Auth()->user()->id,
        ]);
        return response()->json($slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = SliderPrincipal::where('id', $request->id)->first();
        $slider->update([
            'activo' => !$slider['activo'],
        ]);
        toastr('El registro se modifico con exito.');
        return back();

    }

    public function img(Request $request)
    {
        $request->file('file')->move('principal/img', $request->file('file')->getClientOriginalName());
        $img = ImgSlider::first();
        $img->update(['img' => 'principal/img/' . $request->file('file')->getClientOriginalName()]);
    }
}
