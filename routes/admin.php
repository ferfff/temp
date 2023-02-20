<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CodigoPostalController;
use App\Http\Controllers\ColoniaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ControlObraController;
use App\Http\Controllers\DefinicionDocumentoController;
use App\Http\Controllers\DestajoObraController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JornalController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\NotaCreditoController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ObraExtraController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PlantillaCorreoController;
use App\Http\Controllers\PostVentaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\RegistroPatronalController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SirocController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

//Dashboard
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

//Sistema
Route::put('/usuarios-restore/{slug}', [UserController::class, 'restore'])->name('user-restore');
Route::put('/usuarios-password', [UserController::class, 'cambiarPassword'])->name('cambiarPassword');
Route::resource('/usuarios', UserController::class)->except(['show']);

Route::resource('/perfil', PerfilController::class)->only(['edit', 'update']);
Route::post('perfil-upload-img', [PerfilController::class, 'img'])->name('perfil-upload');
Route::put('perfil-password/{perfil}', [PerfilController::class, 'password'])->name('perfil-password');

Route::resource('/roles', RolController::class);

Route::resource('/parametros', ParametroController::class)->only('index', 'update');
Route::put('/parametros-icono/{parametro}', [ParametroController::class, 'icono'])->name('parametros-icono');
Route::put('/parametros-logotipo/{parametro}', [ParametroController::class, 'logotipo'])->name('parametros-logotipo');

Route::resource('/generales', GeneralController::class)->only('index', 'update');

Route::resource('/auditorias', AuditController::class)->only('index', 'show');
Route::get('logs', [LogViewerController::class, 'index'])->name('logs');

Route::post('plantilla-correo-imagen', [PlantillaCorreoController::class, 'img'])->name('plantillaImagen');
Route::put('/plantilla-correos-update', [PlantillaCorreoController::class, 'update'])->name('plantilla-correos-update');
Route::get('/plantilla-correos', [PlantillaCorreoController::class, 'index'])->name('plantilla-correos');

//Principal
Route::resource('/footer', FooterController::class)->only(['index', 'update']);
Route::post('/banner-img-upload', [BannerController::class, 'img'])->name('img');
Route::resource('/banner', BannerController::class)->only(['index', 'store', 'update']);

//Catalogos

Route::post('/estados-import', [EstadoController::class, 'import'])->name('estados-import');
Route::resource('/estados', EstadoController::class)->except('show', 'destroy');

Route::post('/municipios-import', [MunicipioController::class, 'import'])->name('municipios-import');
Route::resource('/municipios', MunicipioController::class)->except('show', 'destroy');

Route::post('/codigos-postales-import', [CodigoPostalController::class, 'import'])->name('codigos-postales-import');
Route::resource('/codigos-postales', CodigoPostalController::class)->except('show', 'destroy');

Route::post('/colonias-import', [ColoniaController::class, 'import'])->name('colonias-import');
Route::resource('/colonias', ColoniaController::class)->except('show', 'destroy');

Route::put('/clientes-restore/{slug}', [ClienteController::class, 'restore'])->name('clientes-restore');
Route::resource('/clientes', ClienteController::class)->except('show');

Route::put('/presupuestos-aprobados', [PresupuestoController::class, 'aprobar'])->name('presupuestos-aprobados');
Route::resource('/presupuestos', PresupuestoController::class)->except('show', 'destroy');

Route::resource('/sirocs', SirocController::class)->except('show', 'destroy');

Route::post('importar-definiciones', [ContratoController::class, 'import'])->name('importar-control_obra');
Route::put('/contratos-restore/{slug}', [ContratoController::class, 'restore'])->name('contratos-restore');
Route::get('/contratos-datos', [ContratoController::class, 'datos'])->name('contratos-datos');
Route::get('/exportar-contrato/{id}', [ContratoController::class, 'export'])->name('exportar-contrato');
Route::resource('/contratos', ContratoController::class)->except('show');

Route::put('/definicion-documentos-restore/{slug}', [DefinicionDocumentoController::class, 'restore'])->name('definicion-documentos-restore');
Route::resource('/definicion-documentos', DefinicionDocumentoController::class)->except('show');

Route::resource('/registros-patronales', RegistroPatronalController::class)->except('show', 'destroy');

Route::resource('/obras', ObraController::class)->except('show', 'destroy');

Route::resource('/factores', FactorController::class)->except('show', 'destroy');

Route::get('control_obra-templete/{contrato}', [ControlObraController::class, 'templete'])->name('definicion-control-obra');
//Route::post('importar-definiciones', [ControlObraController::class, 'import'])->name('importar-control_obra');
Route::get('/exportar-control_obra/{id}', [ControlObraController::class, 'export'])->name('exportar-control_obra');
Route::put('estado-partidas', [ControlObraController::class, 'estado'])->name('contrato-estado');
Route::resource('/control-de-obras', ControlObraController::class)->only('index', 'store', 'show', 'destroy');
Route::post('evidencias-control-de-obra', [DestajoObraController::class, 'evidencia'])->name('evidencia-control');
Route::resource('/destajo-de-obras', DestajoObraController::class)->only('store', 'show');

//Procesos
Route::resource('nota-de-credito', NotaCreditoController::class)->only('index', 'create', 'store', 'destroy');

Route::resource('/expedientes', ExpedienteController::class)->only('index', 'store', 'show', 'update', 'destroy');
Route::put('/expedientes-cambio', [ExpedienteController::class, 'cambio'])->name('expedientes-cambio');
Route::post('expediente-docs', [ExpedienteController::class, 'docs'])->name('expediente-docs');
Route::get('expediente-ver_documentos-tree', [ExpedienteController::class, 'tree'])->name('tree');
Route::get('expediente-ver_documentos-datatable', [ExpedienteController::class, 'table'])->name('table');

Route::put('/estimaciones-aprobados', [EstimacionController::class, 'aprobar'])->name('estimaciones-aprobar');
Route::put('/estimaciones-dictamen', [EstimacionController::class, 'dictamen'])->name('estimaciones-dictamen');
Route::post('/estimaciones-cliente', [EstimacionController::class, 'cliente'])->name('estimaciones-cliente');
Route::resource('/estimaciones', EstimacionController::class)->only('index', 'store', 'show', 'destroy');
Route::post('/estimaciones-upload', [EstimacionController::class, 'upload_documents'])->name('upload-documentos');
Route::get('/estimaciones-download', [EstimacionController::class, 'download_documento'])->name('download-documento');
Route::put('/estimaciones-cambio', [EstimacionController::class, 'cambio'])->name('estimaciones-cambio');

Route::resource('/obras-extras', ObraExtraController::class)->except('create', 'edit');

Route::post('/jornales-import', [JornalController::class, 'import'])->name('jornales-import');
Route::resource('/jornales', JornalController::class)->except('destroy');

Route::resource('/post-ventas', PostVentaController::class)->except('show', 'destroy');

//Whatsapp
Route::post('/whatsapp', [WhatsappController::class, 'send'])->name('whatsapp');
