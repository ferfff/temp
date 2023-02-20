@extends('adminlte::page')

@section('plugins.fileinput', true)

@section('title', 'Colonias')

@section('content_header')
    {{ Breadcrumbs::render('colonia.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Colonias" message="Agregar" route="colonias" icon="fas fa-map-marker-alt"
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
                    <x-layouts.buscador route="colonias" :buscar="$buscar" />
                    <x-tables.table :headers="[
                        'ID',
                        'Nombre',
                        'Tipo Asentamiento',
                        'Codigo Postal',
                        'Municipio',
                        'Estado',
                        'Acciones',
                    ]" id="colonias">
                        @forelse ($colonias as $colonia)
                            <tr>
                                <x-tables.td :key="true">{{ $colonia->id }}</x-tables.td>
                                <x-tables.td>{{ $colonia->nombre }}</x-tables.td>
                                <x-tables.td>{{ $colonia->tipo_asentamiento }}</x-tables.td>
                                <x-tables.td>{{ $colonia->codigoPostal->CP }}</x-tables.td>
                                <x-tables.td>{{ $colonia->municipio->nombre }}</x-tables.td>
                                <x-tables.td>{{ $colonia->estado->nombre }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown route="colonias" :value="$colonia" />
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $colonias->appends(['buscar' => $buscar])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.excel route="colonias-import" />
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
