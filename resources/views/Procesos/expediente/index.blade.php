@extends('adminlte::page')

@section('plugins.iCheck', true)

@section('title', 'Expedientes')

@section('content_header')
    {{ Breadcrumbs::render('expediente.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Expediente" message="Agregar" route="expedientes" icon="fas fa-file-signature"
                    :agregar="false" />

                <div class="card-body">
                    <x-layouts.buscador route="expedientes" :buscar="$buscar" :activo="$activo" :show="true"
                        activos="Completo" inactivos="Incompleto" :fieldset="true">
                        <x-layouts.fieldset legend="Documento Pendientes">
                            <div class="form-check">
                                <div class="icheck-primary">
                                    <input class="form-check-input" type="radio" name="pendiente" id="radios1"
                                        value="0" {{ $pendiente == 0 || $pendiente == null ? 'checked' : '' }}
                                        onchange="submit()">
                                    <label class="form-check-label" for="radios1">Todos</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div class="icheck-warning">
                                    <input class="form-check-input" type="radio" name="pendiente" id="radios2"
                                        value="1" {{ $pendiente == 1 ? 'checked' : '' }} onchange="submit()">
                                    <label class="form-check-label" for="radios2">Faltan documentos</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div class="icheck-warning">
                                    <input class="form-check-input" type="radio" name="pendiente" id="radios3"
                                        value="2" {{ $pendiente == 2 ? 'checked' : '' }} onchange="submit()">
                                    <label class="form-check-label" for="radios3">Documentos Pendientes</label>
                                </div>
                            </div>
                        </x-layouts.fieldset>
                    </x-layouts.buscador>
                    <x-tables.table :headers="[
                        'Folio',
                        'Cliente',
                        'Fecha Firma',
                        'Avance(documentos Obligatorios)',
                        'Documentos Vencidos',
                        'Estado',
                        'Acciones',
                    ]" id="expedientes">
                        @forelse ($contratos as $contrato)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <x-tables.td :key="true">{{ $contrato->folio }}</x-tables.td>
                                <x-tables.td>{{ $contrato->cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ date('d/m/Y', strtotime($contrato->fecha_firma)) }}</x-tables.td>
                                <x-tables.td>
                                    <div class="progress progress-sm">
                                        @php
                                            $total_obligatorio = round($contrato->documentos_obligatorio / $total_documentos_obligatorios, 2);
                                            $total = $total_obligatorio;
                                        @endphp
                                        @if ($contrato->documentos_opcionales != 0)
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $contrato->pendientes_obligatorio == 0 ? 'success' : 'warning' }}"
                                                role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ $total_obligatorio * 100 }}%"></div>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                                role="progressbar"
                                                style="width: {{ round($contrato->documentos_opcionales / $total_documentos, 2) * 100 }}%"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        @else
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $contrato->pendientes_obligatorio == 0 ? 'success' : 'warning' }}"
                                                role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ $total * 100 }}%"></div>
                                        @endif
                                    </div>
                                    <small>
                                        {{ $total * 100 }}% Completo
                                    </small>
                                </x-tables.td>
                                <x-tables.td>
                                    @if ($contrato->seguimientos != 0)
                                        Tienes: {{ $contrato->seguimientos }} documento vencido
                                    @else
                                        {{ '-' }}
                                    @endif
                                </x-tables.td>
                                <x-tables.td>
                                    @if ($contrato->pendientes_obligatorio == 0 && $contrato->total > $total_documentos)
                                        <span class="badge rounded-pill bg-success">Completo</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger text-dark">Incompleto</span>
                                    @endif
                                </x-tables.td>
                                <x-tables.td>
                                    @if ($contrato->deleted_at == null)
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('expedientes.show', $contrato) }}">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                    Ver
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </x-tables.td>
                            </tr>
                            <tr class="expandable-body d-none">
                                <td colspan="7">
                                    <p style="display: none;">
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Folio:</strong>
                                                {{ $contrato->folio }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Cliente:</strong>
                                                {{ $contrato->cliente->razon_social }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Concepto Adenda:</strong>
                                                {{ $contrato->concepto_adenda }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Licencia:</strong>
                                                {{ $contrato->licencia }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Descripcion Contrato:</strong>
                                                {{ $contrato->descripcion_contrato }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Fecha Firma:</strong>
                                                {{ date('d/m/Y', strtotime($contrato->fecha_firma)) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Fecha Inicio:</strong>
                                                {{ date('d/m/Y', strtotime($contrato->fecha_inicio)) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Fecha Cierre Siroc:</strong>
                                                {{ date('d/m/Y', strtotime($contrato->fecha_cierre_siroc)) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Fecha Termino:</strong>
                                                {{ date('d/m/Y', strtotime($contrato->fecha_termino)) }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Monto:</strong>
                                                $ {{ number_format($contrato->importe_contratado, 2, '.', ',') }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Suministros:</strong>
                                                $ {{ number_format($contrato->suministros, 2, '.', ',') }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Total Contrato:</strong>
                                                $ {{ number_format($contrato->total_contrato, 2, '.', ',') }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Monto Anticipo:</strong>
                                                $ {{ number_format($contrato->monto_anticipo, 2, '.', ',') }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Porcentaje Amortizacion Anticipo:</strong>
                                                {{ $contrato->porcentaje_amortizacion_anticipo }}%
                                            </div>
                                            <div class="form-group">
                                                <strong>Porcentaje de retencion:</strong>
                                                {{ $contrato->porcentaje_retencion }}%
                                            </div>
                                            <div class="form-group">
                                                <strong>Permite Deductivas:</strong>
                                                {{ $contrato->permite_deductivas == 1 ? 'Si' : 'No' }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Permite Aditivas:</strong>
                                                {{ $contrato->permite_aditivas == 1 ? 'Si' : 'No' }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Activo:</strong>
                                                {{ $contrato->activo == null ? 'Activo' : 'inactivo' }}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Calle:</strong>
                                                {{ $contrato->calle }}
                                            </div>
                                            <div class="form-group">
                                                <strong>No Ext:</strong>
                                                {{ $contrato->no_ext }}
                                            </div>
                                            <div class="form-group">
                                                <strong>No Int:</strong>
                                                {{ $contrato->no_int }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Colonia:</strong>
                                                {{ $contrato->colonia }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Localidad:</strong>
                                                {{ $contrato->localidad }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Referencia:</strong>
                                                {{ $contrato->referencia }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Municipio:</strong>
                                                {{ $contrato->municipio->nombre }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Estado:</strong>
                                                {{ $contrato->estado->nombre }}
                                            </div>
                                            <div class="form-group">
                                                <strong>Codigo Postal:</strong>
                                                {{ $contrato->codigo_postal }}
                                            </div>
                                        </div>
                                    </div>
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $contratos->appends(['buscar' => $buscar, 'activo' => $activo, 'pendiente' => $pendiente])->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
