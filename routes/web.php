<?php

use App\Http\Controllers\CorreoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['register' => false]);

Route::get('/', PrincipalController::class)->name('principal')->middleware('guest');

// Correo
Route::get('/correos', CorreoController::class)->name('correos')->middleware('correo');

//Whatsapp
Route::post('/webhook', [WhatsappController::class, 'handle'])->name('webhook');

Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
})->name('optimize');

Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Link Storage</h1>';
})->name('storage-link');

Route::get('/down', function () {
    $exitCode = Artisan::call('down');
    return '<h1>DOWN</h1>';
});

Route::get('/up', function () {
    $exitCode = Artisan::call('up');
    return '<h1>UP</h1>';
});
