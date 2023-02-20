@extends('adminlte::page')

@section('title', 'Post Venta')

@section('content_header')
    {{ Breadcrumbs::render('post-ventas.index') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Post Venta') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('post-ventas.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Agregar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-tables.table :headers="['ID', 'Nombre', 'Contrato', 'Monto', 'Fecha Recepcion', 'Estado']">
                            @foreach ($postVentas as $postVenta)
                                <tr>
                                    <x-tables.td>{{ $postVenta->id }}</x-tables.td>

                                    <x-tables.td>{{ $postVenta->nombre }}</x-tables.td>
                                    <x-tables.td>{{ $postVenta->contrato->folio }}</x-tables.td>
                                    <x-tables.td>$ {{ number_format($postVenta->monto, 2, '.', ',') }}</x-tables.td>
                                    <x-tables.td>{{ $postVenta->fecha_recepcion }}</x-tables.td>
                                    <x-tables.td>
                                        @if ($postVenta->estado == 1)
                                            <span class="badge rounded-pill bg-success">Aprobado</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">No Aprobado</span>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('post-ventas.edit', $postVenta->id) }}"><i
                                                class="fa fa-fw fa-edit"></i>
                                            Editar
                                        </a>
                                    </x-tables.td>
                                </tr>
                            @endforeach
                        </x-tables.table>
                        {!! $postVentas->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
