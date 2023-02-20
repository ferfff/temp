@extends('adminlte::page')

@section('title', 'Obras Extras')

@section('content_header')
    {{ Breadcrumbs::render('obraExtra.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Obras Extras" message="Agregar" route="obras-extras" icon="fas fa-file-signature"
                    :agregar="false" />

                <div class="card-body">
                    <x-layouts.buscador route="obras-extras" :buscar="$buscar" />
                    <x-tables.table :headers="['Folio', 'Cliente', 'Fecha Firma', 'Monto', 'Activo', 'Acciones']" id="contratos">
                        @forelse ($contratos as $contrato)
                            <tr>
                                <x-tables.td>{{ $contrato->folio }}</x-tables.td>
                                <x-tables.td>{{ $contrato->cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ $contrato->fecha_firma }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($contrato->monto, 2, '.', ',') }}</x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$contrato->deleted_at == null" />
                                </x-tables.td>
                                <x-tables.td>
                                    @if ($contrato->deleted_at == null)
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('obras-extras.show', $contrato->id) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                            Ver
                                        </a>
                                    @endif
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $contratos->appends(['buscar' => $buscar, 'activo' => $activo])->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
