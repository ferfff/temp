@extends('adminlte::page')

@section('title', 'Factores')

@section('content_header')
    {{ Breadcrumbs::render('factor.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Factores" message="Agregar" route="factores" icon="fas fa-money-bill" />
                <div class="card-body">
                    <x-tables.table :headers="['ID', 'Sdi', 'Sd', 'Salario', 'Puntualidad', 'Asistencia', 'Acciones']" id="factores">
                        @forelse ($factores as $factor)
                            <tr>
                                <x-tables.td :key="true">{{ $factor->id }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($factor->SDI, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($factor->SD, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($factor->salario, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($factor->puntualidad, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($factor->asistencia, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$factor" route="factores" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                </div>
            </div>
            {!! $factores->links() !!}
        </div>
    </div>
@stop
