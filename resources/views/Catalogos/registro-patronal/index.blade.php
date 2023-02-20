@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Registros Patronales')

@section('content_header')
    {{ Breadcrumbs::render('registroPatronal.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Registros Patronales" message="Agregar" route="registros-patronales"
                    icon="fas fa-list" />

                <div class="card-body">
                    <x-layouts.buscador route="registros-patronales" :buscar="$buscar" />
                    <x-tables.table :headers="[
                        'ID',
                        'Razon Social',
                        'Razon Comercial',
                        'Rfc',
                        'Registro Patronal Imss',
                        'Logotipo',
                        'Acciones',
                    ]" id="registroPatronal">
                        @forelse ($registrosPatronales as $registrosPatronale)
                            <tr>
                                <x-tables.td :key="true">{{ $registrosPatronale->id }}</x-tables.td>
                                <x-tables.td>{{ $registrosPatronale->razon_social }}</x-tables.td>
                                <x-tables.td>{{ $registrosPatronale->razon_comercial }}</x-tables.td>
                                <x-tables.td>{{ $registrosPatronale->RFC }}</x-tables.td>
                                <x-tables.td>{{ $registrosPatronale->registro_patronal_imss }}</x-tables.td>
                                <x-tables.td><img src="{{ asset($registrosPatronale->logotipo) }}" class="w-25">
                                </x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$registrosPatronale" route="registros-patronales" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                </div>
            </div>
            {!! $registrosPatronales->appends(['buscar' => $buscar])->links() !!}
        </div>
    </div>
@stop
