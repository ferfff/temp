@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Switch', true)

@section('title', 'Estimaciones')

@section('content_header')
    {{ Breadcrumbs::render('estimacion.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Estimaciones" message="Agregar" route="estimaciones" :agregar="false"
                    icon="fas fa-file-signature" />

                <div class="card-body">
                    <x-layouts.buscador route="estimaciones" :buscar="$buscar" />
                    <p class="text-danger text-center text-uppercase h4 font-weight-bold">En este módulo solo se muestran los
                        contratos que estén activos actualmente</p>
                    <x-tables.table :headers="[
                        'Folio',
                        'Cliente',
                        'Fecha Firma',
                        'Porcentaje',
                        'Fecha de la ultima estimacion',
                        'Hace',
                        'Acciones',
                    ]" id="estimaciones">
                        @forelse ($contratos as $contrato)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <x-tables.td :key="true">{{ $contrato->folio }}</x-tables.td>
                                <x-tables.td>{{ $contrato->cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ date('d/m/Y', strtotime($contrato->fecha_firma)) }}</x-tables.td>
                                <x-tables.td>
                                    ${{ number_format($contrato->total_pagadas, 2, '.', ',') }} -
                                    ${{ number_format($contrato->total_contrato, 2, '.', ',') }}
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                            style="width: {{ round($contrato->total_pagadas / $contrato->total_contrato, 4) * 100 }}%"
                                            role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                            role="progressbar"
                                            style="width: {{ round($contrato->total_en_proceso / $contrato->total_contrato, 4) * 100 }}%"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>
                                        {{ round($contrato->total_pagadas / $contrato->total_contrato, 4) * 100 }}% Pagado
                                    </small>
                                </x-tables.td>
                                <x-tables.td>
                                    {{ $contrato->estimaciones->count() > 0 ? date('d/m/Y h:i:s a', strtotime($contrato->estimaciones->first()->created_at)) : 'Sin estimaciones' }}
                                </x-tables.td>
                                <x-tables.td>
                                    {{ $contrato->estimaciones->count() > 0
                                        ? \Carbon\Carbon::parse($contrato->estimaciones->first()->created_at)->diffForHumans([
                                            'parts' => 2,
                                            'join' => ', ',
                                            'short' => true,
                                        ])
                                        : '-' }}
                                </x-tables.td>
                                <x-tables.td>
                                    @if ($contrato->deleted_at == null)
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('estimaciones.show', $contrato) }}"
                                                    onclick="{{ $contrato->expediente == 1 ? true : false }}">
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
                                                {{ $contrato->porcentaje_garantias }}%
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
                    {{ $contratos->appends(['buscar' => $buscar, 'activo' => $activo])->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
    </script>
@stop
