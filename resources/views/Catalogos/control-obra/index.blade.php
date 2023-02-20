@extends('adminlte::page')

@section('title', 'Control de Obras')

@section('content_header')
    {{ Breadcrumbs::render('control-de-obras.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Control De Obras" message="Agregar" route="estimaciones" :agregar="false"
                    icon="fas fa-file-signature" />
                <div class="card-body">
                    <x-tables.table :headers="['Folio', 'Cliente', 'Fecha Firma', 'Importe contratado', 'Base', 'Estado', 'Acciones']" id="contratos">
                        @forelse ($contratos as $contrato)
                            <x-tables.tr :item="$contrato" :detalle="true" :expandable="true" columns="8">
                                <x-tables.td :key="true">{{ $contrato->folio }}</x-tables.td>
                                <x-tables.td>{{ $contrato->cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ date('d/m/Y', strtotime($contrato->fecha_firma)) }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($contrato->importe_contratado, 2, '.', ',') }}
                                </x-tables.td>
                                <x-tables.td>
                                    @if (str_contains($contrato->model_type, 'Presupuesto'))
                                        {{ 'Presupuesto' }}
                                    @else
                                        {{ 'Siroc' }}
                                    @endif
                                </x-tables.td>
                                <x-tables.td>
                                    <form action="{{ route('contrato-estado') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        @if ($contrato->estado_partidas == 0)
                                            <input type="hidden" name="contrato_id" value="{{ $contrato->uid }}">
                                            <input type="checkbox" name="estado_partidas" id="estado_partidas"
                                                onchange="submit()" {{ $contrato->estado_partidas ? 'checked' : '' }}
                                                {{ $contrato->estado_partidas ? 'readonly' : '' }}>
                                        @else
                                            <span class="badge rounded-pill bg-info">Terminado</span>
                                        @endif
                                    </form>
                                </x-tables.td>
                                <x-tables.td>
                                    @can('control-de-obras.store')
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('control-de-obras.show', $contrato) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                            Definicion
                                        </a>
                                    @endcan
                                    @can('destajo-de-obras.store')
                                        @if ($contrato->control_count > 0 && $contrato->estado_partidas == 1)
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('destajo-de-obras.show', $contrato) }}">
                                                <i class="fa fa-fw fa-eye"></i>
                                                Destajo
                                            </a>
                                        @endif
                                    @endcan
                                </x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                </div>
            </div>
        </div>
    </div>
@stop
