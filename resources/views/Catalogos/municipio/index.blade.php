@extends('adminlte::page')

@section('plugins.fileinput', true)

@section('title', 'Municipios')

@section('content_header')
    {{ Breadcrumbs::render('municipio.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Municipios" message="Agregar" route="municipios" icon="fas fa-map-marker-alt"
                    :excel="true" />
                <div class="card-body">
                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            <x-listas.ul :value="$errors->all()" />
                        </div>
                    @endif
                    @if (session()->has('failures'))
                        <x-tables.table :headers="['Columna', 'Atributo', 'Error', 'Value']" class="table-danger">
                            @foreach (session()->get('failures') as $validation)
                                <tr>
                                    <x-tables.td>{{ $validation->row() }}</x-tables.td>
                                    <x-tables.td>{{ $validation->attribute() }}</x-tables.td>
                                    <x-tables.td>
                                        <x-listas.ul :value="$validation->errors()" />
                                    </x-tables.td>
                                    <x-tables.td>{{ $validation->values()[$validation->attribute()] }}</x-tables.td>
                                </tr>
                            @endforeach
                        </x-tables.table>
                    @endif
                    <x-layouts.buscador route="municipios" :buscar="$buscar" />
                    <x-tables.table :headers="['ID', 'Nombre', 'Estado', 'Acciones']" id="municipio">
                        @forelse ($municipios as $municipio)
                            <tr>
                                <x-tables.td :key="true">{{ $municipio->id }}</x-tables.td>
                                <x-tables.td>{{ $municipio->nombre }}</x-tables.td>
                                <x-tables.td>{{ $municipio->estado->nombre }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown route="municipios" :value="$municipio" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $municipios->appends(['buscar' => $buscar])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.excel route="municipios-import" />
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
