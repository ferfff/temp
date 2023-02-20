@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Obras')

@section('content_header')
    {{ Breadcrumbs::render('obra.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Obras" message="Agregar" route="obras" icon="fas fa-building" />

                <div class="card-body">
                    <x-layouts.buscador route="obras" :buscar="$buscar" />
                    <x-tables.table :headers="['ID', 'Registro Patronal', 'Clave Obra', 'Nombre', 'Acciones']" id="obras">
                        @forelse ($obras as $obra)
                            <tr>
                                <x-tables.td :key="true">{{ $obra->id }}</x-tables.td>
                                <x-tables.td>{{ $obra->registroPatronal->razon_social }}</x-tables.td>
                                <x-tables.td>{{ $obra->clave_obra }}</x-tables.td>
                                <x-tables.td>{{ $obra->nombre }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$obra" route="obras" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                </div>
            </div>
            {!! $obras->appends(['buscar' => $buscar])->links() !!}
        </div>
    </div>
@stop
