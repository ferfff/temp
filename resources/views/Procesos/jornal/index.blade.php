@extends('adminlte::page')

@section('title', 'Jornales')

@section('content_header')
    {{ Breadcrumbs::render('jornal.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Jornales" message="Agregar" route="jornales" icon="fas fa-users" :excel="true" />
                <div class="card-body">
                    <x-tables.table :headers="[
                        'ID',
                        'Nss',
                        'Nombre Completo',
                        'Departamento',
                        'Curp',
                        'Dias Laborados',
                        'Sdi',
                        'Acciones',
                    ]" id="clientes">

                        @foreach ($jornales as $jornale)
                            <tr>
                                <x-tables.td>{{ $jornale->id }}</x-tables.td>

                                <x-tables.td>{{ $jornale->NSS }}</x-tables.td>
                                <x-tables.td>{{ $jornale->nombre_completo }}</x-tables.td>
                                <x-tables.td>{{ $jornale->departamento }}</x-tables.td>
                                <x-tables.td>{{ $jornale->curp }}</x-tables.td>
                                <x-tables.td>{{ $jornale->dias_laborados }}</x-tables.td>
                                <x-tables.td>{{ $jornale->SDI }}</x-tables.td>

                                <x-tables.td>
                                    <x-buttons.dropdown route="jornales" :value="$jornale" />
                                </x-tables.td>
                            </tr>
                        @endforeach
                    </x-tables.table>
                    {!! $jornales->links() !!}
                </div>
            </div>
        </div>
    </div>
    <x-modals.excel route="jornales-import" />
@stop
