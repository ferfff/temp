@extends('adminlte::page')

@section('plugins.fileinput', true)

@section('title', 'Codigos Postales')

@section('content_header')
    {{ Breadcrumbs::render('codigoPostal.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Codigos Postales" message="Agregar" route="codigos-postales"
                    icon="fas fa-map-marker-alt" :excel="true" />

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
                    <x-layouts.buscador route="codigos-postales" :buscar="$buscar" />
                    <x-tables.table :headers="['ID', 'C.P.', 'Estado', 'Municipio', 'Acciones']" id="CP">
                        @foreach ($codigosPostales as $codigoPostal)
                            <tr>
                                <x-tables.td :key="true">{{ $codigoPostal->id }}</x-tables.td>
                                <x-tables.td>{{ $codigoPostal->CP }}</x-tables.td>
                                <x-tables.td>{{ $codigoPostal->estado->nombre }}</x-tables.td>
                                <x-tables.td>{{ $codigoPostal->municipio->nombre }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown route="codigos-postales" :value="$codigoPostal" />
                                </x-tables.td>
                            </tr>
                        @endforeach
                    </x-tables.table>
                    {{ $codigosPostales->appends(['buscar' => $buscar])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.excel route="codigos-postales-import" />
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
