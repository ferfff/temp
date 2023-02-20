<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ControlObraController;
use App\Http\Controllers\DestajoObraController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\NotaCreditoController;
use App\Http\Controllers\PlantillaCorreoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\SirocController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('/contratos-municipios/{id}', [ContratoController::class, 'municipios']);
Route::get('/contratos-cp', [ContratoController::class, 'cp']);
Route::get('/contratos-colonias', [ContratoController::class, 'colonias']);
Route::get('/contratos-clientes', [ContratoController::class, 'clientes']);
Route::get('/contrato-presupuesto', [ContratoController::class, 'presupuesto_siroc']);
Route::get('/contrato-base/{modelo}', [ContratoController::class, 'base']);
Route::get('/contrato-datos/{modelo}/{id}', [ContratoController::class, 'datos']);

Route::get('expediente-bitacora/{id}', [ExpedienteController::class, 'bitacora'])->name('bitacora');
Route::get('expediente-aplazamiento_seguimiento', [ExpedienteController::class, 'aplazamiento_seguimiento']);

Route::get('/presupuesto-clientes', [PresupuestoController::class, 'clientes']);
Route::get('bitacora-presupuesto/{id}', [PresupuestoController::class, 'bitacora']);

Route::get('/siroc-clientes', [SirocController::class, 'clientes']);
Route::get('/siroc-datos/{id}', [SirocController::class, 'datos']);
Route::get('bitacora-siroc/{id}', [SirocController::class, 'bitacora']);
Route::get('presupuestos-siroc', [SirocController::class, 'presupuestos']);
Route::get('siroc-folio-presupuesto', [PresupuestoController::class, 'folio']);
Route::get('/presupuesto-datos/{id}', [PresupuestoController::class, 'datos']);

Route::get('/correos-clientes/{id}', [ClienteController::class, 'correos']);
Route::get('/uso-correos/{proceso}', [ClienteController::class, 'uso']);

Route::get('/usuarios-accesos/{id}', [UserController::class, 'accesos']);

Route::get('plantilla-correos/{id}', [PlantillaCorreoController::class, 'plantilla']);

Route::get('bitacora-estimaciones/{id}', [EstimacionController::class, 'bitacora']);
Route::get('estimacion-documentos', [EstimacionController::class, 'documentos']);
Route::get('estimacion-documentos-cliente', [EstimacionController::class, 'documentos_cliente']);

Route::get('cliente-nota_credito/{id}', [NotaCreditoController::class, 'cliente']);

Route::get('unidad-de-medida', [ControlObraController::class, 'unidades']);
Route::get('contrato-control_obra/{id}', [ControlObraController::class, 'contrato']);

Route::get('definiciones', [DestajoObraController::class, 'definiciones']);
