@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{ Breadcrumbs::render('dashboard') }}
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <h1>Bienvenido al sistema de Jornales</h1>
            </div>
            <div class="row col-md-12">
                <x-layouts.box size="3" color="info" :value="$presupuestos_total" title="presupuestos" route="presupuestos" />
                <x-layouts.box size="3" color="danger" :value="$expedientes_aprobacion" title="Documentos que necesitan aprobacion"
                    route="expedientes" />
                <x-layouts.box size="3" color="success" :value="$expedientes_seguimiento"
                    title="Documentos que necesitan un seguimiento" route="expedientes" />
                <x-layouts.box size="3" color="warning" :value="$estimaciones" title="Estimaciones por cobrar"
                    route="estimaciones" />
            </div>
            <div class="row">
                <x-layouts.chart :value="$presupuestos" color="primary" sizeColumn="4" />
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Contratos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <x-tables.table :headers="[
                                'Contrato',
                                'Cliente',
                                'Proceso',
                                'Fecha De La Ultima Estimacion',
                                'Hace',
                                'Acciones',
                            ]">
                                @foreach ($contratos as $contrato)
                                    <x-tables.tr :item="$contrato" :expandable="true" columns="6">
                                        <x-tables.td>
                                            <a>{{ $contrato->folio }}</a>
                                            <br>
                                            <small>{{ $contrato->created_at }}</small>
                                        </x-tables.td>
                                        <x-tables.td> {{ $contrato->razon_social }} </x-tables.td>
                                        <x-tables.td>
                                            <x-layouts.progress :valueMin="$contrato->estimacion" :valueMax="$contrato->total_contrato" />
                                        </x-tables.td>
                                        <x-tables.td>
                                            {{ $contrato->estimaciones->count() > 0 ? date('d/m/Y h:i:s a', strtotime($contrato->reciente)) : 'Sin estimaciones' }}
                                        </x-tables.td>
                                        <x-tables.td>
                                            {{ $contrato->estimaciones->count() > 0
                                                ? \Carbon\Carbon::parse($contrato->reciente)->diffForHumans([
                                                    'parts' => 2,
                                                    'join' => ', ',
                                                    'short' => true,
                                                ])
                                                : '-' }}
                                        </x-tables.td>
                                        <x-tables.td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('estimaciones.show', $contrato->uid) }}">
                                                <i class="fas fa-folder"></i> Ver
                                            </a>
                                        </x-tables.td>
                                    </x-tables.tr>
                                @endforeach
                            </x-tables.table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('dashboard') }}" method="get">
                        <div class="form-group">
                            <label for="search">Buscar</label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ $search }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                    @if (count($results) > 0)
                        <ul>
                            @forelse ($results as $data)
                                <li>
                                    @if (class_basename($data) == 'Contrato')
                                        <strong>Contrato: </strong>{{ $data->folio }}
                                    @elseif(class_basename($data) == 'Presupuesto')
                                        <strong>Presupuesto: </strong>{{ $data->folio }}
                                    @elseif(class_basename($data) == 'Siroc')
                                        <strong>Siroc: </strong>{{ $data->folio }}
                                    @endif
                                    <strong>Cliente: </strong>{{ $data->cliente->razon_social }}
                                    <strong>Fecha: </strong>{{ $data->created_at }}
                                </li>
                            @empty
                                <li>No hay informacion disponible</li>
                            @endforelse
                        </ul>
                    @endif
                </div>
                <div class="col-md-6">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listWeek',
                locale: 'es',
                events: @json($eventos)
            });
            calendar.render();
        });
    </script>
    {!! $presupuestos->renderChartJsLibrary() !!}
    {!! $presupuestos->renderJs() !!}
@stop
