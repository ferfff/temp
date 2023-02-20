@extends('adminlte::page')

@section('plugins.Numeral', true)
@section('plugins.Switch', true)
@section('plugins.Datatables', true)
@section('plugins.iCheck', true)
@section('plugins.fileinput', true)
@section('plugins.DualList', true)

@section('title', 'Estimacion')

@section('content_header')
    {{ Breadcrumbs::render('estimacion.show', $contrato) }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            <h2><i class="fas fa-file-signature"></i> Estimaciónes: {{ $contrato->folio }}
                                <small>{{ $contrato->cliente->razon_social }}</small>
                            </h2>
                        </span>
                        <div class="float-right">
                            @if ($contrato->total_pagadas < $contrato->total_contrato ||
                                $contrato->total_pendiente < $contrato->total_contrato)
                                <button type="button" class="btn btn-primary btn-sm float-right ml-2" data-placement="left"
                                    data-toggle="modal" data-target="#agregar-modal">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            @endif
                            <a href="{{ route('estimaciones.index') }}" class="btn btn-secondary btn-sm float-right">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <center>
                        <div class="row">
                            <div class="col-md-11">
                                ${{ number_format($contrato->total_pagadas, 2, '.', ',') }} -
                                ${{ number_format($contrato->total_contrato, 2, '.', ',') }}
                                <div class="progress">
                                    <div class="progress-bar bg-success"
                                        style="width: {{ round($contrato->total_pagadas / $contrato->total_contrato, 4) * 100 }}%"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        {{ round($contrato->total_pagadas / $contrato->total_contrato, 4) * 100 }}%
                                    </div>
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ round($contrato->total_proceso / $contrato->total_contrato, 4) * 100 }}%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ round($contrato->total_proceso / $contrato->total_contrato, 4) * 100 }}%
                                    </div>
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ round($contrato->total_pendiente / $contrato->total_contrato, 4) * 100 }}%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ round($contrato->total_pendiente / $contrato->total_contrato, 4) * 100 }}%
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                                    <i class="fas fa-info"></i>
                                </button>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-2 mb-2">
                            <x-layouts.fieldset legend="Etapa 1">
                                <div class="row">
                                    <div class="form-check ml-2">
                                        <div class="icheck-primary">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios1" value="" checked>
                                            <label class="form-check-label" for="exampleRadios1">Todos</label>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-info">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios2" value="Revision">
                                            <label class="form-check-label" for="exampleRadios2">En revision</label>
                                            <button type="button" class="btn btn-sm btn-info" data-container="body"
                                                data-toggle="popover" data-placement="top" data-trigger="focus"
                                                data-content="SE HA CAPTURADO LA ESTIMACION y esta pendiente que el opertador de costos apruebe su envio, podria permitir adjuntar mas dicumentos en este estatus">
                                                <i class="fas fa-question-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-info">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios4" value="Cliente">
                                            <label class="form-check-label" for="exampleRadios4">Enviada al cliente</label>
                                            <button type="button" class="btn btn-sm btn-info" data-container="body"
                                                data-toggle="popover" data-placement="top" data-trigger="focus"
                                                data-content="SE ENVIO AL CLIENTE, en espera de recibir el acuse ">
                                                <i class="fas fa-question-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-info">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios3" value="Pendiente">
                                            <label class="form-check-label" for="exampleRadios3">Pendiente de pago</label>
                                            <button type="button" class="btn btn-sm btn-info" data-container="body"
                                                data-toggle="popover" data-placement="top" data-trigger="focus"
                                                data-content="Se debera marcar asi, si fue acepta por el cliente a tramite de pago, adjuntar el acuse. ">
                                                <i class="fas fa-question-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </x-layouts.fieldset>
                        </div>
                        <div class="col-md-6 mt-2 mb-2">
                            <x-layouts.fieldset legend="Etapa 2">
                                <div class="form-check ml-2">
                                    <div class="icheck-warning">
                                        <input class="form-check-input" type="radio" name="activo"
                                            id="exampleRadios6" value="Cancelada">
                                        <label class="form-check-label" for="exampleRadios6">Canceladas</label>
                                        <button type="button" class="btn btn-sm btn-info" data-container="body"
                                            data-toggle="popover" data-placement="top" data-trigger="focus"
                                            data-content="Si el operador de costos, decidio cancelar el envio o tramite de la estimacion una decision interna ">
                                            <i class="fas fa-question-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-check ml-2">
                                    <div class="icheck-danger">
                                        <input class="form-check-input" type="radio" name="activo"
                                            id="exampleRadios5" value="Rechazada">
                                        <label class="form-check-label" for="exampleRadios5">Rechazadas</label>
                                        <button type="button" class="btn btn-sm btn-info" data-container="body"
                                            data-toggle="popover" data-placement="top" data-trigger="focus"
                                            data-content="El cliente no acepto la estimacion, especificar el motivo ">
                                            <i class="fas fa-question-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-check ml-2">
                                    <div class="icheck-success">
                                        <input class="form-check-input" type="radio" name="activo"
                                            id="exampleRadios7" value="Pagada">
                                        <label class="form-check-label" for="exampleRadios7">Pagadas</label>
                                        <button type="button" class="btn btn-sm btn-info" data-container="body"
                                            data-toggle="popover" data-placement="top" data-trigger="focus"
                                            data-content="EL COBRO DE LA ESTIMACION SE HA REALIZADO">
                                            <i class="fas fa-question-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </x-layouts.fieldset>
                        </div>
                    </div>
                    <x-tables.table :headers="[
                        'No. de Estimación',
                        'Fecha de Estimación',
                        'Monto Total a Facturar',
                        'Acumulado',
                        'Estado',
                        'Acciones',
                    ]">
                        @php
                            $acumulado = 0;
                            $retenido = 0;
                            $amortizacion = 0;
                        @endphp
                        @foreach ($estimaciones as $estimacion)
                            <tr>
                                <x-tables.td :key="true">{{ $estimacion->no_estimacion }}</x-tables.td>
                                <x-tables.td>{{ date('d/m/Y', strtotime($estimacion->fecha_estimacion)) }}</x-tables.td>
                                <x-tables.td>${{ number_format($estimacion->monto_facturar, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>${{ number_format($acumulado, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>{{ $estimacion->estado }}</x-tables.td>
                                <x-tables.td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown">
                                            Opciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @can('estimaciones.update')
                                                <button class="dropdown-item" data-toggle="modal" data-target="#show-modal"
                                                    data-id="{{ $estimacion->id }}"
                                                    data-numero_estimacion="{{ $estimacion->no_estimacion }}"
                                                    data-fecha_estimacion="{{ $estimacion->fecha_estimacion }}"
                                                    data-monto_ejecutar="{{ $estimacion->monto_ejecutar }}"
                                                    data-acumulado="{{ $acumulado }}"
                                                    data-monto_facturar="{{ $estimacion->monto_facturar }}"
                                                    data-comentario="{{ $estimacion->comentario }}"
                                                    data-retencion_monto="{{ $estimacion->retencion_monto }}"
                                                    data-retencion_porcentaje="{{ $estimacion->retencion_porcentaje }}"
                                                    data-total_facturar="{{ $estimacion->total_facturar }}"
                                                    data-monto_amortizacion="{{ $estimacion->amortizacion_monto }}"
                                                    data-porcentaje_amortizacion="{{ $estimacion->amortizacion_porcentaje }}"
                                                    data-retenido="{{ $retenido + $estimacion->retencion_monto }}">
                                                    <i class="fa fa-fw fa-eye"></i> Ver
                                                </button>
                                            @endcan
                                            @if ($estimacion->estado == 'Revision')
                                                @can('estimaciones.aprobar')
                                                    <a type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-cliente" data-estimacion="{{ $estimacion->id }}">
                                                        <i class="fas fa-share-square"></i> Enviar al cliente
                                                    </a>
                                                @endcan
                                            @endif
                                            @if ($estimacion->estado == 'Cliente')
                                                @can('estimaciones.cliente')
                                                    <a type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-aprobar" data-id="{{ $estimacion->id }}">
                                                        <i class="fas fa-check"></i> Aprobar
                                                    </a>
                                                @endcan
                                            @endif
                                            @if ($estimacion->estado == 'Pendiente')
                                                @can('estimaciones.dictamen')
                                                    <a type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-dictamen" data-id="{{ $estimacion->uuid }}">
                                                        <i class="fas fa-check-double"></i> Estado final
                                                    </a>
                                                @endif
                                            @endcan
                                            @can('estimaciones.documento')
                                                @if ($estimacion->estado == 'Revision')
                                                    <button class="dropdown-item" data-toggle="modal"
                                                        data-target="#upload-documentos" data-id="{{ $estimacion->uuid }}">
                                                        <i class="fas fa-plus-circle"></i> Agregar documento
                                                    </button>
                                                @endif
                                                <button type="button" class="dropdown-item" data-toggle="modal"
                                                    data-target="#tabla-documentos" data-id="{{ $estimacion->uuid }}">
                                                    <i class="fas fa-book"></i> Ver documentos
                                                </button>
                                                @if ($estimacion->complemento_pago != null)
                                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-Webviewer"
                                                        data-archivo="{{ $estimacion->complemento_pago }}">
                                                        <i class="fas fa-book"></i> Ver Complemento
                                                    </button>
                                                @endif
                                                <button type="button" class="dropdown-item" data-toggle="modal"
                                                    data-target="#modal-download_documento"
                                                    data-estimacion="{{ $estimacion->id }}">
                                                    <i class="fas fa-file-download"></i> Documento conjunto
                                                </button>
                                            @endcan
                                            <a type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#ver-bitacora" data-id="{{ $estimacion->uuid }}">
                                                <i class="fas fa-tasks"></i> Bitacora
                                            </a>
                                        </div>
                                    </div>
                                </x-tables.td>
                            </tr>
                            @php
                                if ($estimacion->estado != 'Rechazada' && $estimacion->estado != 'Cancelada') {
                                    $acumulado += $estimacion->monto_facturar;
                                    $amortizacion += $estimacion->amortizacion_monto;
                                    if ($estimacion->estado != 'Pagada') {
                                        $retenido += $estimacion->retencion_monto;
                                    }
                                }
                            @endphp
                        @endforeach
                    </x-tables.table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-success d-flex justify-content-between align-items-center">
                                    pagadas:
                                    <span>{{ round($contrato->total_pagadas / $contrato->total_contrato, 4) * 100 }}% -
                                        ${{ number_format($contrato->total_pagadas, 2, '.', ',') }}</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-center">
                                    En proceso:
                                    <span>{{ round($contrato->total_proceso / $contrato->total_contrato, 4) * 100 }}% -
                                        ${{ number_format($contrato->total_proceso, 2, '.', ',') }}</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-center">
                                    Pendiente de Pago:
                                    <span>{{ round($contrato->total_pendiente / $contrato->total_contrato, 4) * 100 }}% -
                                        ${{ number_format($contrato->total_pendiente, 2, '.', ',') }}</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center">
                                    Total estimado:
                                    <span>{{ round($contrato->total_estimado / $contrato->total_contrato, 4) * 100 }}%
                                        - ${{ number_format($contrato->total_estimado, 2, '.', ',') }}</span>
                                </a>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="list-group">
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-between align-items-center">
                                    Total
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimaciones_count }}
                                    </span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-center">
                                    En Revision
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_revision }}
                                    </span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-center">
                                    Enviada al cliente
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_cliente }}
                                    </span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-info d-flex justify-content-between align-items-center">
                                    Pendiente de pago
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_pendiente }}
                                    </span>
                                </a>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul class="list-group">
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-danger d-flex justify-content-between align-items-center">
                                    Canceladas
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_cancelada }}
                                    </span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-warning d-flex justify-content-between align-items-center">
                                    Rechazadas
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_rechazada }}
                                    </span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action list-group-item-success d-flex justify-content-between align-items-center">
                                    Pagadas
                                    <span class="badge badge-primary badge-pill">
                                        {{ $contrato->estimacion_pagada }}
                                    </span>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-Webviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 h-auto d-inline-block">
                        <div id='viewer' style='width: 1024px; height: 600px; margin: 0 auto;'></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tabla-documentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-tables.table :headers="['Archivo', 'Tipo', 'Activo', 'Acciones']" id="table-documentos" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload-documentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('upload-documentos') }}" method="post" enctype="multipart/form-data"
                        id="formulario-upload_documento">
                        <input type="hidden" name="h_documento_estimacion_id" id="h_documento_estimacion_id">
                        <input type="hidden" name="h_documento_contrato_id" id="h_documento_contrato_id"
                            value="{{ $contrato->id }}">
                        <div class="form-group">
                            <select name="tipo" class="form-control" id="tipo_documento" required>
                                <option value=""></option>
                                <option value="Documento Completo">Documento Completo</option>
                                <option value="Caratula">Caratula</option>
                                <option value="Matriz">Matriz</option>
                                <option value="Factura(pdf)">Factura(pdf)</option>
                                <option value="Factura(xml)">Factura(xml)</option>
                                <option value="Evidencias">Evidencias</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" name="archivo" id="archivo-upload-documento"
                                accept="application/pdf,image/*,text/xml" multiple required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="enviar-upload_documentos">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregar-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('Procesos.estimacion.create')
            </div>
        </div>
    </div>
    <div class="modal fade" id="show-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if ($estimaciones->count())
                    @include('Procesos.estimacion.view')
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="ver-bitacora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bitacora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <table id="bitacora" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Accion</th>
                                <th>Comentario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-dictamen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('estimaciones-dictamen') }}" method="post" id="formulario-dictamen"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Costos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="estimacion_id">
                        <input type="hidden" name="contrato" value="{{ $contrato->uid }}">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado_dictamen" class="form-control">
                                <option value=""></option>
                                <option value="Pagada">Pagada</option>
                                <option value="Rechazada">Rechazada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_pago">Fecha de pago</label>
                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento de pago</label>
                            <input type="file" name="complemento" id="complemento" accept="application/pdf">
                        </div>
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <textarea name="comentario" id="comentario_dictamen" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="enviar-dictamen">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-modals.confirm text="Agregar" idButton="button-crear" />
    <x-modals.confirm text="Cliente" idModal="confirm-cliente" idButton="button-cliente" />
    <x-modals.confirm text="Aprobar/Rechazar" idModal="confirm-aprobar" idButton="button-aprobar" />
    <x-modals.confirm text="Finalizar" idModal="confirm-dictamen" idButton="button-dictamen" />
    <x-modals.confirm text="Acuse" idModal="confirm-acuse" idButton="button-acuse" />
    <x-modals.confirm text="Subir documento" idModal="confirm-upload_documento" idButton="button-upload_documento" />
    <x-modals.confirm text="Editar" idModal="confirm-cambio" idButton="button-cambiar" />
    <div class="modal fade" id="confirm-eliminar-documento" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_eliminar">
                    <label>¿Quieres eliminar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="button-eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-generar_documento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generar documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_eliminar">
                    <label>¿Quieres generar el documento?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="button-generar">Generar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('estimaciones-cliente') }}" method="post" id="formulario-cliente">
                    @csrf
                    <input type="hidden" name="estimacion_id" id="estimacion_id">
                    <input type="hidden" name="contrato_id" id="contrato_id" value="{{ $contrato->uid }}">
                    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $contrato->cliente_id }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>¿Quieres enviar los documentos al cliente?</label>
                        <input type="hidden" name="documentos" id="h-cliente_documentos">
                        <select name="duallistbox[]" id="duallistbox" multiple></select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#confirm-cliente" id="enviar-cliente">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-download_documento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('download-documento') }}" method="get" id="formulario-download_documento"
                    target="_blank">
                    @csrf
                    <input type="hidden" name="contrato_id" id="contrato_id" value="{{ $contrato->uid }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="documentos" id="h-generar_documento">
                        <select name="download_duallistbox[]" id="download_documento-duallist" multiple></select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#confirm-generar_documento" id="enviar-generar">Generar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-aprobar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('estimaciones-aprobar') }}" method="post" id="formulario-acuse"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estimacion_id" id="estimacion_id">
                    <input type="hidden" name="contrato_id" id="contrato_id" value="{{ $contrato->uid }}">
                    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $contrato->cliente_id }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Estimacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>¿Quieres aprobar la estimacion?</label>
                        <div class="form-group row">
                            <label for="select_aprobar" class="col-md-2 col-form-label">Aprobar</label>
                            <select name="aprobar" id="select_aprobar" class="form-control col-md-10">
                                <option value=""></option>
                                <option value="Pendiente">Aprobado</option>
                                <option value="Revisión">Corregir</option>
                                <option value="Cancelar">Cancelar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="acuse">Acuse</label>
                            <input type="file" name="acuse" id="acuse" accept="application/pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-aporbacion">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cambiar" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('estimaciones-cambio') }}" method="POST" id="formulario-cambiar"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambio en el tipo de documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" value="Recategorizar" id="accion_value">
                        <input type="hidden" name="user" id="user_auth" value="{{ Auth()->user()->fullname }}">
                        <input type="hidden" name="archivo_id" id="archivo_id-cambio">
                        <div class="form-group">
                            <p><b>Seleccione el documento</b></p>
                            <select name="documento_id" id="documento_id_cambio" class="form-control" required>
                                <option value=""></option>
                                <option value="Documento Completo">Documento Completo</option>
                                <option value="Caratula">Caratula</option>
                                <option value="Matriz">Matriz</option>
                                <option value="Factura(pdf)">Factura(pdf)</option>
                                <option value="Factura(xml)">Factura(xml)</option>
                                <option value="Evidencias">Evidencias</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-cambio">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('webviewer/lib/webviewer.min.js') }}"></script>
    <script src="{{ asset('js/multi-modal.js') }}"></script>
    <script>
        $('#modal-cambiar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #archivo_id-cambio').val(button.data('id'))
        })
        $("#enviar-cambio").on("click", function(e) {
            $("#confirm-cambio").modal("show");
        });
        $("#button-cambiar").click(function() {
            $(this).prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append("archivo_id", $('#archivo_id-cambio').val());
            formData.append("tipo", $('#documento_id_cambio').val());
            formData.append("user", $('#user_auth').val());
            formData.append("accion", $('#accion_value').val());
            formData.append("accion", $('#accion_value').val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('estimaciones-cambio') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    table_documentos.ajax.reload()
                    toastr.success('Registro modificado con exito.')
                    $("#confirm-cambio").modal("hide");
                    $('#modal-cambiar').modal("hide")
                    $(this).prop('disabled', false);
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $(this).prop('disabled', false);
                }
            });
            //$("#formulario-cambiar").submit();
        });
        var demo2 = $('select[name="duallistbox[]"]').bootstrapDualListbox({
            sortByInputOrder: true,
            showFilterInputs: false,
            infoText: false,
            moveOnSelect: false,
        });
        var demo = $('select[name="download_duallistbox[]"]').bootstrapDualListbox({
            sortByInputOrder: true,
            showFilterInputs: false,
            infoText: false,
            moveOnSelect: false,
        });
        $('#amortizacion_monto').change(function() {
            if (numeral($(this).val()).value() < numeral($('#total_anticipo')[0].textContent).value()) {
                $(this).val(numeral($(this).val()).format('$0,0.00'))
                $('#amortizacion_porcentaje').val(numeral(numeral($(this).val()).value() /
                    (numeral($('#total_anticipo')[0].textContent).value())).format('0.00%'))
            } else {
                toastr.warning('El monto de amortizacion no puede ser mayor a ' + $('#total_anticipo')[0]
                    .textContent)
                $('#enviar-crear').prop('disabled', true)
            }
        })
        $('#amortizacion_porcentaje').change(function() {
            if (numeral($(this).val()).value() < 100) {
                $('#enviar-crear').prop('disabled', false)
                $(this).val(numeral($(this).val() / 100).format('0.00%'))
                $('#amortizacion_monto').val(numeral(numeral($('#total_anticipo')[0].textContent).value() *
                    (numeral($(this).val()).value())).format('$0,0.00'))
            } else {
                toastr.warning('El porcentaje no puede ser mayor a 100%')
                $('#enviar-crear').prop('disabled', true)
            }
        })
        $('[data-toggle="popover"]').popover()
        table_principal = $('#table').DataTable({
            columnDefs: [{
                targets: 0,
                searching: false,
            }, {
                targets: [2, 3],
                orderable: false,
            }, {
                targets: 5,
                orderable: false,
                searching: false,
            }],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        })
        $('input:radio').click(function() {
            table_principal.search($(this).val()).draw()
        })
        $("#enviar-dictamen").on("click", function(e) {
            if ($('#formulario-dictamen').valid()) {
                $("#confirm-dictamen").modal("show");
            }
        });
        $('#button-dictamen').on("click", function(e) {
            $("#button-dictamen").prop('disabled', true);
            $('#formulario-dictamen').submit()
        });
        $('#enviar-cliente').click(function() {
            var array = []
            var children = Array.from($('#duallistbox').bootstrapDualListbox('getContainer')[0].children[1]
                .children[4]);
            $("#h-cliente_documentos").val('');
            children.forEach(element => {
                array.push($(element).val());
                $("#h-cliente_documentos").val(array.join(","));
            });
        })
        $('#button-cliente').click(function() {
            $(this).prop('disabled', true);
            $('#formulario-cliente').submit()
        })
        $('#modal-cliente').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            $.ajax({
                url: '/api/estimacion-documentos-cliente',
                data: {
                    estimacion_id: button.data('estimacion')
                },
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, value) {
                        let $option = $(`<option value='` + value.nombre + `'>` + value.tipo +
                            `</option>`);
                        demo2.append($option);
                    });
                    demo2.bootstrapDualListbox('refresh')
                }
            });

            modal.find('.modal-content #estimacion_id').val(button.data('estimacion'))
        })
        $('#modal-cliente').on('hidden.bs.modal', function(event) {
            var children = Array.from($('select[name="duallistbox[]"]')[0].children);
            children.forEach(element => {
                $(element).remove()
            });
            demo2.bootstrapDualListbox('refresh')
        })
        $('#enviar-generar').click(function() {
            var array = []
            var children = Array.from($('#download_documento-duallist').bootstrapDualListbox('getContainer')[0]
                .children[1]
                .children[4]);
            $("#h-generar_documento").val('');
            children.forEach(element => {
                array.push($(element).val());
                $("#h-generar_documento").val(array.join(","));
            });
        })
        $('#button-generar').click(function() {
            $('#formulario-download_documento').submit()
            $('#confirm-generar_documento').modal("hide")
        })
        $('#modal-download_documento').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            $.ajax({
                url: '/api/estimacion-documentos-cliente',
                data: {
                    estimacion_id: button.data('estimacion')
                },
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $.each(data, function(index, value) {
                        let $option = $(`<option value='` + value.nombre + `'>` + value.tipo +
                            `</option>`);
                        demo.append($option);
                    });
                    demo.bootstrapDualListbox('refresh')
                }
            });
        })
        $('#modal-download_documento').on('hidden.bs.modal', function(event) {
            var children = Array.from($('select[name="download_duallistbox[]"]')[0].children);
            children.forEach(element => {
                $(element).remove()
            });
            demo.bootstrapDualListbox('refresh')
        })
        $('#aprobar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            modal.find('.modal-content #id').val(button.data('id'))
        })
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Cobrada",
            offText: 'Rechazada'
        });
        $('#enviar-upload_documentos').click(function() {
            if ($('#archivo-upload-documento').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-upload_documento').valid()) {
                $("#confirm-upload_documento").modal("show");
            }
        })
        $("#button-upload_documento").click(function() {
            $("#button-upload_documento").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append("contrato_id", $('#h_documento_contrato_id').val());
            formData.append("estimacion_id", $('#h_documento_estimacion_id').val());
            formData.append("tipo", $('#tipo_documento').val());
            var ins = document.getElementById('archivo-upload-documento').files.length;
            for (var x = 0; x < ins; x++) {
                formData.append("archivos[]", document.getElementById('archivo-upload-documento').files[x]);
            }
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('upload-documentos') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm-upload_documento").modal("hide")
                    $("#button-upload_documento").prop('disabled', false);
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-upload_documento").prop('disabled', false);
                }
            });
        });
        $('#upload-documentos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            modal.find('.modal-content #h_documento_estimacion_id').val(button.data('id'))
        })
        $("#enviar-crear").on("click", function(e) {
            if ($('#formulario-crear').valid()) {
                $("#confirm").modal("show");
            }
        });
        $("#button-crear").click(function() {
            $("#button-crear").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('no_estimacion', $('#numero_estimacion').val())
            formData.append('fecha_estimacion', $("#fecha_estimacion").val());
            formData.append('monto_ejecutar', $("#monto_ejecutar").val());
            formData.append('monto_facturar', $("#monto_facturar").val());
            formData.append('retencion_monto', $("#retencion").val());
            formData.append('retencion_porcentaje', $("#porcentaje").val());
            formData.append('total_facturar', $("#total_facturar").val());
            formData.append('amortizacion_monto', $("#amortizacion_monto").val());
            formData.append('amortizacion_porcentaje', $("#amortizacion_porcentaje").val());
            formData.append('comentario', $("#comentario").val());
            formData.append('contrato_id', "{{ $contrato->uid }}");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('estimaciones.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-crear").prop('disabled', false);
                    window.location.href = "{{ route('estimaciones.show', $contrato->uid) }}"
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-crear").prop('disabled', false);
                }
            });
        });
        $("#enviar-crear").on("click", function(e) {
            if ($('#archivo').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-crear').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#formulario-crear').validate({
            rules: {
                fecha_estimacion: {
                    required: true
                },
                monto_ejecutar: {
                    required: true,
                },
                monto_facturar: {
                    required: true,
                },
                archivo: {
                    required: true,
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            invalidHandler: function(event, validator) {
                //console.log(validator.errorList)
                if (validator.numberOfInvalids()) {
                    ion.sound.play("error");
                }
            },
            errorClass: "invalid-tooltip"
        })
        $('#enviar-aporbacion').on("click", function(e) {
            if ($('#formulario-acuse').valid()) {
                $("#confirm-acuse").modal("show");
            }
        });
        $('#button-acuse').click(function() {
            $(this).prop('disabled', true)
            $('#formulario-acuse').submit()
            $("#confirm-acuse").modal("show")
        })
        $('#formulario-acuse').validate({
            rules: {
                aprobar: {
                    required: true
                },
                acuse: {
                    required: function() {
                        return $('#acuse').val() == 'Pendiente';
                    },
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            invalidHandler: function(event, validator) {
                if (validator.numberOfInvalids()) {
                    ion.sound.play("error");
                }
            },
            errorClass: "invalid-tooltip"
        })
        $('#formulario-dictamen').validate({
            rules: {
                estado: {
                    required: true
                },
                complemento: {
                    required: function() {
                        return $('#estado_dictamen').val() == 'Pagada';
                    },
                },
                comentario: {
                    //required: true
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            invalidHandler: function(event, validator) {
                if (validator.numberOfInvalids()) {
                    ion.sound.play("error");
                }
            },
            errorClass: "invalid-tooltip"
        })
        $('#modal-aprobar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #estimacion_id').val(button.data('id'))
        })
        $('#modal-dictamen').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #estimacion_id').val(button.data('id'))
        })
        $('#show-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            modal.find('.modal-content #id').val(button.data('id'))
            modal.find('.modal-content #numero_estimacion2').val(button.data('numero_estimacion'))
            modal.find('.modal-content #fecha_estimacion2').val(button.data('fecha_estimacion'))
            modal.find('.modal-content #comentario2').val(button.data('comentario'))
            modal.find('.modal-content #monto_ejecutar2').val(numeral(button.data('monto_ejecutar')).format(
                '$0,0.00'))
            modal.find('.modal-content #acumulado2').val(numeral(button.data('acumulado')).format(
                '$0,0.00'))
            modal.find('.modal-content #monto_facturar2').val(numeral(button.data('monto_facturar')).format(
                '$0,0.00'))
            modal.find('.modal-content #retencion2').val(numeral(button.data('retencion_monto')).format(
                '$0,0.00'))
            modal.find('.modal-content #retencion_acumulado2').val(numeral(button.data('retenido')).format(
                '$0,0.00'))
            modal.find('.modal-content #porcentaje2').val(numeral(
                button.data('retencion_porcentaje') / 100).format('0.00%'))
            modal.find('.modal-content #total_facturar2').val(numeral(button.data('total_facturar')).format(
                '$0,0.00'))
            modal.find('.modal-content #amortizacion2').val(numeral(button.data('monto_amortizacion')).format(
                '$0,0.00'))
            modal.find('.modal-content #amortizacion_porcentaje2').val(numeral(
                button.data('porcentaje_amortizacion') / 100).format('0.00%'))
        })
        var table_bitacora
        $('#ver-bitacora').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            table_bitacora = $('#bitacora').DataTable({
                ajax: '/api/bitacora-estimaciones/' + button.data('id'),
                retrieve: true,
                columns: [{
                        data: 'user'
                    },
                    {
                        data: 'accion'
                    },
                    {
                        data: 'comentario'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
        })
        $('#ver-bitacora').on('hidden.bs.modal', function(event) {
            table_bitacora.destroy();
        })
        var table_documentos
        $('#tabla-documentos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            table_documentos = $('#table-documentos').DataTable({
                ajax: '/api/estimacion-documentos?estimacion_id=' + button.data('id'),
                retrieve: true,
                paging: false,
                searching: false,
                columns: [{
                        data: 'nombre',
                        render: function(data, type, full, meta) {
                            icono = ''
                            if (full.extension == 'pdf') {
                                icono = `<i class="fas fa-file-pdf"></i>`
                            }
                            if (full.extension == 'png' || full.extension == 'jpg' ||
                                full.extension == 'jpeg') {
                                icono = `<i class="fas fa-file-image"></i>`
                            }
                            if (full.extension == 'xml' || full.extension == 'XML') {
                                icono = `<i class="fas fa-file-invoice-dollar"></i>`
                            }
                            return `<center><a href="#" style="font-size: 75px;" data-toggle="modal"
                                    data-target="#modal-Webviewer" data-archivo="` + data + `">
                                    ` + icono + `
                                </a></center>`
                        },
                    },
                    {
                        data: 'tipo'
                    },
                    {
                        data: 'activo',
                        render: function(data, type, row, meta) {
                            return data == null ? 'Actual' : 'Historial'
                        }
                    },
                    {
                        data: 'id',
                        orderable: false,
                        render: function(data, type, row, meta) {
                            boton = ``
                            if (row.estimacion.estado == 'Revision') {
                                boton = `<button type="button" class="btn btn-transparent"
                                    data-toggle="modal" data-target="#confirm-eliminar-documento"
                                    data-id="` + data + `">
                                    <i class="fas fa-trash text-info"></i>
                                </button>
                                <button type="button"class="btn btn-transparent"
                                    data-toggle="modal" data-target="#modal-cambiar"
                                    data-id="` + data + `">
                                    <i class="fas fa-random text-info"></i>
                                </button>`
                            }
                            return boton
                        }
                    }
                ],
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
        })
        $('#confirm-eliminar-documento').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #id_eliminar').val(button.data('id'))
        })
        $("#button-eliminar").click(function() {
            $("#button-eliminar").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('estimacion_id', $("#id_eliminar").val());
            formData.append("_method", "DELETE");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('estimaciones.destroy', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    if (event.seguidos_count > 0) {
                        toastr.warning('Este documento tiene documentos que le pertenecen.')
                    } else {
                        toastr.success('Registro Eliminado con exito.')
                    }
                    $("#confirm-eliminar-documento").modal("hide")
                    $("#button-eliminar").prop('disabled', false);
                    table_documentos.ajax.reload()
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-eliminar").prop('disabled', false);
                }
            });
        });
        $('#tabla-documentos').on('hidden.bs.modal', function(event) {
            table_documentos.destroy();
        })
        $('#modal-Webviewer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            WebViewer({
                    path: "{{ asset('WebViewer/lib') }}",
                }, document.getElementById('viewer'))
                .then(instance => {
                    instance.UI.dispose();
                    instance.UI.setLanguage('es');
                    instance.UI.loadDocument(button.data('archivo'));
                });
        })
        $("#monto_facturar").change(function() {
            var total_contrato = {{ $contrato->total_contrato }}
            $(this).val(numeral($(this).val()).format('$0,0.00'))
            $('#total').val(numeral(numeral($('#acumulado').val()).value() + numeral($(this).val()).value())
                .format('$0,0.00'))
            if (numeral($('#total').val()).value() > total_contrato) {
                $('#enviar-crear').prop('disabled', true)
                toastr.warning('La cantidad total del contrato es: ' + total_contrato + ' y el acumulado lo supera')
            } else {
                $('#enviar-crear').prop('disabled', false)
            }
            $('#monto_ejecutar').val(numeral(numeral($('#total_contrato').val()).value() - (numeral($(
                    '#h_acumulado')
                .val()).value() + numeral($(this).val()).value())).format('$0,0.00'))
            $('#retencion').val(numeral(numeral($(this).val()).value() * (numeral($('#porcentaje').val()).value()))
                .format('$0,0.00'))
            $('#total_facturar').val(numeral(numeral($(this).val()).value() - numeral($('#retencion').val())
                .value()).format('$0,0.00'))
            $('#retencion_acumulado').val(numeral(numeral($('#h_retencion_acumulado').val()).value() +
                numeral($('#retencion').val()).value()).format('$0,0.00'))
        });
        $("#complemento").fileinput({
            theme: "explorer",
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf"],
            maxFileSize: 5000,
        });
        $("#archivo-upload-documento").fileinput({
            theme: "explorer",
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf", "xml", "jpg", "jpeg", 'png'],
            maxFileSize: 5000,
            preferIconicPreview: true,
            previewFileIconSettings: {
                'doc': '<i class="fas fa-file-word text-primary"></i>',
                'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                'img': '<i class="fas fa-image text-warning"></i>',
                'xml': '<i class="fas fa-file-invoice-dollar text-success"></i>',
            },
            previewFileExtSettings: {
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'pdf': function(ext) {
                    return ext.match(/(pdf)$/i);
                },
                'img': function(ext) {
                    return ext.match(/(png|jpg|jpeg)$/i);
                },
                'xml': function(ext) {
                    return ext.match(/(xml|XML)$/i);
                }
            }
        });
        $('#porcentaje').change(function() {
            if (numeral($(this).val()).value() < 100) {
                $(this).val(numeral($(this).val() / 100).format('0.00%'))
                $('#retencion').val(numeral(numeral($('#monto_facturar').val()).value() *
                    (numeral($(this).val()).value())).format('$0,0.00'))
                $('#total_facturar').val(numeral(numeral($('#monto_facturar').val()).value() - numeral($(
                        '#retencion')
                    .val()).value()).format('$0,0.00'))
                $('#retencion_acumulado').val(numeral(numeral($('#h_retencion_acumulado').val()).value() +
                    numeral($('#retencion').val()).value()).format('$0,0.00'))
            } else {
                toastr.warning('El porcentaje no puede ser mayor a 100%')
                $('#enviar-crear').prop('disabled', true)
            }
        })
        $('#retencion').change(function() {
            if (numeral($(this).val()).value() < numeral($('#monto_facturar').val()).value()) {
                $(this).val(numeral($(this).val()).format('$0,0.00'))
                $('#porcentaje').val(numeral(numeral($('#retencion').val()).value() /
                    (numeral($('#monto_facturar').val()).value())).format('0.00%'))
                $('#total_facturar').val(numeral(numeral($('#monto_facturar').val()).value() - numeral($(
                        '#retencion')
                    .val()).value()).format('$0,0.00'))
                $('#retencion_acumulado').val(numeral(numeral($('#h_retencion_acumulado').val()).value() +
                    numeral($('#retencion').val()).value()).format('$0,0.00'))
            } else {
                toastr.warning('El monto de amortizacion no puede ser mayor a ' + numeral($('#monto_facturar')
                        .val())
                    .format('$0,0.00'))
                $('#enviar-crear').prop('disabled', true)
            }
        })
    </script>
    @if ($estimaciones->count() > 0)
        <script>
            $('#porcentaje2').change(function() {
                $(this).val(numeral($(this).val() / 100).format('0.00%'))
                $('#retencion2').val(numeral(numeral($('#monto_facturar2').val()).value() *
                    (numeral($(this).val()).value())).format('$0,0.00'))
                $('#total_facturar2').val(numeral(numeral($('#monto_facturar2').val()).value() - numeral(
                    $('#retencion2').val()).value()).format('$0,0.00'))
            })
            $('#retencion2').change(function() {
                $(this).val(numeral($(this).val()).format('$0,0.00'))
                $('#porcentaje2').val(numeral(numeral($('#retencion2').val()).value() /
                    (numeral($('#monto_facturar2').val()).value())).format('0.00%'))
                $('#total_facturar2').val(numeral(numeral($('#monto_facturar2').val()).value() - numeral($(this)
                    .val()).value()).format('$0,0.00'))
            })
            $("#archivo-caratula2").fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            });
            $("#archivo-matriz2").fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            });
            $("#archivo-factura2").fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            });
            $("#archivo-factura_xml2").fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            });
            $("#archivo-evidencias2").fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            });
            $('#acuse').fileinput({
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["pdf", "xml"],
                maxFileSize: 5000,
                showPreview: false
            })
        </script>
    @endif
@stop
