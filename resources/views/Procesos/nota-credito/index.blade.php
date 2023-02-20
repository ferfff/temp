@extends('adminlte::page')

@section('plugins.DateRange', true)

@section('title', 'Nota de Credito')

@section('content_header')
    {{ Breadcrumbs::render('nota-de-credito.index') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Nota de Credito
                            </span>
                            @can('nota-de-credito.store')
                                <div class="float-right">
                                    <a href="{{ route('nota-de-credito.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        Agregar
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <x-layouts.buscador route="nota-de-credito" :buscar="$buscar" :activo="$activo" :show="true"
                            :range="true" :datarange="$datarange" activos="Aplicadas" inactivos="Por aplicar" />
                        <x-tables.table :headers="['Id', 'Cliente', 'Emisor', 'Estatus', 'Folio', 'Fecha', 'Monto', 'Acciones']">
                            @foreach ($notaCreditos as $notaCredito)
                                <tr>
                                    <x-tables.td>{{ $notaCredito->id }}</x-tables.td>
                                    <x-tables.td>{{ $notaCredito->cliente->razon_social }}</x-tables.td>
                                    <x-tables.td>{{ $notaCredito->emisor }}</x-tables.td>
                                    <x-tables.td>
                                        {{ $notaCredito->estimacion_id != null ? 'Aplicada' : 'Por Aplicar' }}
                                    </x-tables.td>
                                    <x-tables.td>{{ $notaCredito->folio }}</x-tables.td>
                                    <x-tables.td>
                                        {{ \Carbon\Carbon::parse($notaCredito->fecha)->format('d/m/Y h:m:s') }}
                                    </x-tables.td>
                                    <x-tables.td>$ {{ number_format($notaCredito->monto, 2, '.', ',') }}</x-tables.td>
                                    <x-tables.td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('nota-de-credito.destroy')
                                                    @if ($notaCredito->estimacion_id == null)
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#confirm-delete" data-id="{{ $notaCredito->uuid }}">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    @endcan
                                                @endif
                                                <button type="button" class="dropdown-item" id="abrir-archivo"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    data-archivo="{{ asset($notaCredito->pdf) }}">
                                                    <i class="fas fa-book"></i> Ver pdf
                                                </button>
                                                <a href="{{ asset($notaCredito->xml) }}" class="dropdown-item" download
                                                    target="_blank">Descargar xml</a>
                                            </div>
                                        </div>
                                    </x-tables.td>
                                </tr>
                            @endforeach
                        </x-tables.table>
                        {!! $notaCreditos->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 h-auto d-inline-block">
                        <div id='viewer' style='width: 1024px; height: 600px; margin: 0 auto;'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($notaCreditos) > 0)
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('nota-de-credito.destroy', $notaCredito->first()) }}" method="POST"
                    onsubmit="checkSubmit()">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label>¿Quieres eliminar el registro?</label>
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" id="button">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@stop

@section('js')
    <script src="{{ asset('webviewer/lib/webviewer.min.js') }}"></script>
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            WebViewer({
                    path: "{{ asset('WebViewer/lib') }}",
                }, document.getElementById('viewer'))
                .then(instance => {
                    instance.UI.dispose();
                    instance.UI.setLanguage('es');
                    instance.UI.loadDocument(button.data('archivo'));
                });
        })
        $('#confirm-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-body #id').val(button.data('id'))
        })
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            autoApply: true,
            locale: {
                format: 'DD/M/Y',
                separator: " - ",
                applyLabel: "Aplicar",
                cancelLabel: "Cancelar",
                fromLabel: "De",
                toLabel: "A",
                customRangeLabel: "Perzonalizado",
                weekLabel: "S",
                daysOfWeek: [
                    "D",
                    "L",
                    "M",
                    "Mi",
                    "J",
                    "V",
                    "S"
                ],
                monthNames: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                firstDay: 1
            },
        })
    </script>
@stop
