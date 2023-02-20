<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Audit;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use App\Models\Cliente;
use App\Models\CodigoPostal;
use App\Models\Colonia;
use App\Models\Contrato;
use App\Models\DefinicionDocumento;
use App\Models\Estado;
use App\Models\Factor;
use App\Models\Jornal;
use App\Models\Municipio;
use App\Models\Obra;
use App\Models\PostVenta;
use App\Models\Presupuesto;
use App\Models\RegistroPatronal;
use App\Models\Rol;
use App\Models\Siroc;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Dashboard
Breadcrumbs::for('dashboard', fn(BreadcrumbTrail $trail) => $trail
    ->push('Darboard', route('home'))
);

//Sistema
Breadcrumbs::for('sistema', fn(BreadcrumbTrail $trail) => $trail
    ->push('Sistema')
);

//Sistema/Usuarios
Breadcrumbs::for('users.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Usuarios', route('usuarios.index'))
);

Breadcrumbs::for('users.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('users.index')
    ->push('Agregar Usuario')
);

Breadcrumbs::for('users.update', fn(BreadcrumbTrail $trail, User $user) => $trail
    ->parent('users.index')
    ->push($user->name, route('usuarios.edit', $user))
);

//Sistema/Perfil
Breadcrumbs::for('perfil.edit', fn(BreadcrumbTrail $trail, User $user) => $trail
    ->parent('users.index')
    ->push('Perfil')
    ->push($user->name, route('perfil.edit', $user))
);

//Sistema/Roles
Breadcrumbs::for('roles.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Roles', route('roles.index'))
);

Breadcrumbs::for('roles.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('roles.index')
    ->push('Agregar Rol')
);

Breadcrumbs::for('roles.update', fn(BreadcrumbTrail $trail, Rol $role) => $trail
    ->parent('roles.index')
    ->push($role->name, route('roles.update', $role))
);

//Sistema/Configuraciones Generales
Breadcrumbs::for('generales', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Configuraciones')
);

//Sistema/Configuraciones Generales/arametros
Breadcrumbs::for('parametros.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('generales')
    ->push('Parametros', route('parametros.index'))
);

//Sistema/Configuraciones Generales/plantilla de correos
Breadcrumbs::for('plantilla.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('generales')
    ->push('Plantilla de correos', route('plantilla-correos'))
);

//Sistema/Configuraciones Generales/Generales
Breadcrumbs::for('generales.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('generales')
    ->push('Generales', route('generales.index'))
);

//Sistema/Configuraciones Generales/Definicion de Documentos
Breadcrumbs::for('definicionDocumentos.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('generales')
    ->push('Definicion de Documentos', route('definicion-documentos.index'))
);

Breadcrumbs::for('definicionDocumentos.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('definicionDocumentos.index')
    ->push('Agregar Documento')
);

Breadcrumbs::for('definicionDocumentos.update', fn(BreadcrumbTrail $trail, DefinicionDocumento $documento) => $trail
    ->parent('definicionDocumentos.index')
    ->push($documento->nombre, route('definicion-documentos.update', $documento))
);

//Sistema/Pantalla de Inicio
Breadcrumbs::for('home', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Pantalla de inicio')
);

//Sistema/Pantalla de Inicio/Banner
Breadcrumbs::for('banner.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('home')
    ->push('Banner', route('banner.index'))
);

//Sistema/Pantalla de Inicio/Footer
Breadcrumbs::for('footer.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('home')
    ->push('Footer', route('footer.index'))
);

//Sistema/Informacion SEPOMEX
Breadcrumbs::for('sepomex', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Informacion SEPOMEX')
);

//Sistema/Informacion SEPOMEX/Estados
Breadcrumbs::for('estado.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sepomex')
    ->push('Estados', route('estados.index'))
);

Breadcrumbs::for('estado.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('estado.index')
    ->push('Agregar Estado')
);

Breadcrumbs::for('estado.update', fn(BreadcrumbTrail $trail, Estado $estado) => $trail
    ->parent('estado.index')
    ->push($estado->nombre, route('estados.update', $estado))
);

//Sistema/Informacion SEPOMEX/Municipios
Breadcrumbs::for('municipio.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sepomex')
    ->push('Municipios', route('municipios.index'))
);

Breadcrumbs::for('municipio.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('municipio.index')
    ->push('Agregar Municipio')
);

Breadcrumbs::for('municipio.update', fn(BreadcrumbTrail $trail, Municipio $municipio) => $trail
    ->parent('municipio.index')
    ->push($municipio->nombre, route('municipios.update', $municipio))
);

//Sistema/Informacion SEPOMEX/Codigos Postales
Breadcrumbs::for('codigoPostal.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sepomex')
    ->push('Codigo Postal', route('codigos-postales.index'))
);

Breadcrumbs::for('codigoPostal.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('codigoPostal.index')
    ->push('Agregar Codigo Postal')
);

Breadcrumbs::for('codigoPostal.update', fn(BreadcrumbTrail $trail, CodigoPostal $codigoPostal) => $trail
    ->parent('codigoPostal.index')
    ->push($codigoPostal->CP, route('codigos-postales.update', $codigoPostal))
);

//Sistema/Informacion SEPOMEX/Colonia
Breadcrumbs::for('colonia.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sepomex')
    ->push('Colonia', route('colonias.index'))
);

Breadcrumbs::for('colonia.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('colonia.index')
    ->push('Agregar Colonia')
);

Breadcrumbs::for('colonia.update', fn(BreadcrumbTrail $trail, Colonia $colonia) => $trail
    ->parent('colonia.index')
    ->push($colonia->nombre, route('colonias.update', $colonia))
);

//Sistema/Auditorias
Breadcrumbs::for('auditorias', fn(BreadcrumbTrail $trail) => $trail
    ->parent('sistema')
    ->push('Auditorias')
);

Breadcrumbs::for('auditorias.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('auditorias')
    ->push('Registros', route('auditorias.index'))
);

Breadcrumbs::for('auditorias.show', fn(BreadcrumbTrail $trail, Audit $audit) => $trail
    ->parent('auditorias.index')
    ->push($audit->auditable_id, route('auditorias.show', $audit))
);

//Cliente
Breadcrumbs::for('clientes', fn(BreadcrumbTrail $trail) => $trail
    ->push('Clientes')
);

//Clientes/Cliente
Breadcrumbs::for('cliente.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('clientes')
    ->push('Clientes', route('clientes.index'))
);

Breadcrumbs::for('cliente.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('cliente.index')
    ->push('Agregar Cliente')
);

Breadcrumbs::for('cliente.show', fn(BreadcrumbTrail $trail, Cliente $cliente) => $trail
    ->parent('cliente.index')
    ->push($cliente->razon_social, route('clientes.show', $cliente))
);

Breadcrumbs::for('cliente.update', fn(BreadcrumbTrail $trail, Cliente $cliente) => $trail
    ->parent('cliente.index')
    ->push($cliente->razon_social, route('clientes.update', $cliente))
);

//Clientes/Presupuestos
Breadcrumbs::for('presupuesto.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('clientes')
    ->push('Presupuesto', route('presupuestos.index'))
);

Breadcrumbs::for('presupuesto.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('presupuesto.index')
    ->push('Agregar Presupuesto')
);

Breadcrumbs::for('presupuesto.update', fn(BreadcrumbTrail $trail, Presupuesto $presupuesto) => $trail
    ->parent('presupuesto.index')
    ->push($presupuesto->folio . " - " . $presupuesto->cliente->razon_social, route('presupuestos.update', $presupuesto))
);

//Clientes/Siroc
Breadcrumbs::for('siroc.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('clientes')
    ->push('Siroc', route('sirocs.index'))
);

Breadcrumbs::for('siroc.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('siroc.index')
    ->push('Agregar Siroc')
);

Breadcrumbs::for('siroc.update', fn(BreadcrumbTrail $trail, Siroc $siroc) => $trail
    ->parent('siroc.index')
    ->push($siroc->folio . " - " . $siroc->cliente->razon_social, route('sirocs.update', $siroc))
);

//Clientes/Expedientes
Breadcrumbs::for('expediente.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('clientes')
    ->push('Expedientes', route('expedientes.index'))
);

Breadcrumbs::for('expediente.show', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('expediente.index', $contrato)
    ->push($contrato->cliente->razon_social, route('expedientes.show', $contrato))
);

//Flujo de Efectivo
Breadcrumbs::for('flujoEfectivo', fn(BreadcrumbTrail $trail) => $trail
    ->push('Flujo de Efectivo')
);

//Flujo de Efectivo/Contrato
Breadcrumbs::for('contrato.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('flujoEfectivo')
    ->push('Contrato', route('contratos.index'))
);

Breadcrumbs::for('contrato.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('contrato.index')
    ->push('Agregar Contrato')
);

Breadcrumbs::for('contrato.update', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('contrato.index')
    ->push($contrato->folio, route('contratos.edit', $contrato))
);

//Flujo de Efectivo/Nota Credito
Breadcrumbs::for('nota-de-credito.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('flujoEfectivo')
    ->push('Nota de Credito', route('nota-de-credito.index'))
);

Breadcrumbs::for('nota-de-credito.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('nota-de-credito.index')
    ->push('Agregar Nota de Credito', route('nota-de-credito.store'))
);

//Flujo de Efectivo/Estimaciones
Breadcrumbs::for('estimacion.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('flujoEfectivo')
    ->push('Estimaciones', route('estimaciones.index'))
);

Breadcrumbs::for('estimacion.show', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('estimacion.index')
    ->push($contrato->cliente->razon_social, route('estimaciones.show', $contrato))
);

//Flujo de Efectivo/Post Ventas
Breadcrumbs::for('post-ventas.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('flujoEfectivo')
    ->push('Post Ventas', route('post-ventas.index'))
);

Breadcrumbs::for('post-ventas.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('post-ventas.index')
    ->push('Agregar Post Venta', route('post-ventas.store'))
);

Breadcrumbs::for('post-ventas.update', fn(BreadcrumbTrail $trail, PostVenta $postVenta) => $trail
    ->parent('jornal.index')
    ->push($postVenta->nombre, route('post-ventas.update', $postVenta->nombre))
);

//Procesos/Obras Extras
Breadcrumbs::for('obraExtra.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('flujoEfectivo')
    ->push('Obras Extras', route('obras-extras.index'))
);

Breadcrumbs::for('obraExtra.show', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('obraExtra.index')
    ->push($contrato->cliente->razon_social, route('obras-extras.show', $contrato))
);

//Jornales
Breadcrumbs::for('jornales', fn(BreadcrumbTrail $trail) => $trail
    ->push('Jornales')
);

//Jornales/Jornales
Breadcrumbs::for('jornal.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('jornales')
    ->push('Jornales', route('jornales.index'))
);

Breadcrumbs::for('jornal.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('jornal.index')
    ->push('Agregar Jornal', route('jornales.store'))
);

Breadcrumbs::for('jornal.show', fn(BreadcrumbTrail $trail, Jornal $jornale) => $trail
    ->parent('jornal.index')
    ->push($jornale->nombre_completo, route('jornales.show', $jornale->slug))
);

Breadcrumbs::for('jornal.update', fn(BreadcrumbTrail $trail, Jornal $jornale) => $trail
    ->parent('jornal.index')
    ->push($jornale->nombre_completo, route('jornales.update', $jornale->slug))
);

//Jornales/Registros Patronales
Breadcrumbs::for('registroPatronal.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('jornales')
    ->push('Registros Patronales', route('registros-patronales.index'))
);

Breadcrumbs::for('registroPatronal.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('registroPatronal.index')
    ->push('Agregar Registro Patronal')
);

Breadcrumbs::for('registroPatronal.show', fn(BreadcrumbTrail $trail, RegistroPatronal $registroPatronal) => $trail
    ->parent('registroPatronal.index')
    ->push($registroPatronal->razon_social, route('registros-patronales.show', $registroPatronal))
);

Breadcrumbs::for('registroPatronal.update', fn(BreadcrumbTrail $trail, RegistroPatronal $registroPatronal) => $trail
    ->parent('registroPatronal.index')
    ->push($registroPatronal->razon_social, route('registros-patronales.update', $registroPatronal))
);

//Jornales/Obras
Breadcrumbs::for('obra.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('jornales')
    ->push('Obras', route('obras.index'))
);

Breadcrumbs::for('obra.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('obra.index')
    ->push('Agregar Obra')
);

Breadcrumbs::for('obra.update', fn(BreadcrumbTrail $trail, Obra $obra) => $trail
    ->parent('obra.index')
    ->push($obra->clave_obra, route('obras.update', $obra))
);

//Jornales/Factores
Breadcrumbs::for('factor.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('jornales')
    ->push('Factores', route('factores.index'))
);

Breadcrumbs::for('factor.store', fn(BreadcrumbTrail $trail) => $trail
    ->parent('factor.index')
    ->push('Agregar Factor')
);

Breadcrumbs::for('factor.update', fn(BreadcrumbTrail $trail, Factor $factor) => $trail
    ->parent('factor.index')
    ->push($factor->id, route('factores.update', $factor))
);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Catalogos/Control de Obra
Breadcrumbs::for('control-de-obras.index', fn(BreadcrumbTrail $trail) => $trail
    ->parent('catalogo')
    ->push('Control de Obra', route('control-de-obras.index'))
);

Breadcrumbs::for('control-de-obras.show', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('control-de-obras.index')
    ->push($contrato->cliente->razon_social, route('control-de-obras.show', $contrato))
);

Breadcrumbs::for('destajo-de-obras.show', fn(BreadcrumbTrail $trail, Contrato $contrato) => $trail
    ->parent('control-de-obras.index')
    ->push($contrato->cliente->razon_social, route('destajo-de-obras.show', $contrato))
);
