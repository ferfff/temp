@extends('adminlte::page')

@section('plugins.fileinput', true)

@section('title', 'Estados')

@section('content_header')
    {{ Breadcrumbs::render('estado.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Estados" message="Agregar" route="estados" icon="fas fa-map-marker-alt"
                    :excel="true" />
                <div class="card-body">
                    <x-layouts.buscador route="estados" :buscar="$buscar" />
                    <x-tables.table :headers="['ID', 'Nombre', 'Codigo Sat', 'Acciones']" id="estados">
                        @forelse ($estados as $estado)
                            <tr>
                                <x-tables.td :key="true">{{ $estado->id }}</x-tables.td>
                                <x-tables.td>{{ $estado->nombre }}</x-tables.td>
                                <x-tables.td>{{ $estado->codigo_sat }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown route="estados" :value="$estado" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $estados->appends(['buscar' => $buscar])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.excel route="estados-import" />
@stop

@section('js')
    <script>
        $("#archivo").fileinput({
            language: "es",
            allowedFileExtensions: ['xls', 'xlsx'],
            maxFilesize: 1,
            showUpload: true,
        });
    </script>
@stop
