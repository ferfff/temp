@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Switch', true)
@section('plugins.iCheck', true)

@section('title', 'Clientes')

@section('content_header')
    {{ Breadcrumbs::render('cliente.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Clientes" message="Agregar" route="clientes" icon="fas fa-users" />
                <div class="card-body">
                    <x-layouts.buscador route="clientes" :buscar="$buscar" :activo="$activo" :show="true" />
                    <x-tables.table :headers="[
                        'ID',
                        'Razon Social',
                        'Rfc',
                        'Contacto',
                        'Activo',
                        'Registro Patronal',
                        'Repse',
                        'Acciones',
                    ]" id="clientes">
                        @forelse ($clientes as $cliente)
                            <tr>
                                <x-tables.td :key="true">{{ $cliente->id }}</x-tables.td>
                                <x-tables.td>{{ $cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ $cliente->RFC }}</x-tables.td>
                                <x-tables.td>{{ $cliente->contacto }}</x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$cliente->deleted_at == null" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>{{ $cliente->registro_patronal }}</x-tables.td>
                                <x-tables.td>{{ $cliente->repse }}</x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$cliente" route="clientes">
                                        <a type="button" class="dropdown-item" data-toggle="modal" data-target="#detalle"
                                            data-id="{{ $cliente->id }}" data-presupuesto="{{ $cliente->presupuesto }}"
                                            data-siroc="{{ $cliente->siroc }}"
                                            data-expediente="{{ $cliente->expediente }}">
                                            <i class="fas fa-asterisk"></i> Detalle
                                        </a>
                                    </x-buttons.dropdown-eliminar>
                                </x-tables.td>
                            </tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $clientes->appends(['buscar' => $buscar, 'activo' => $activo])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal-eliminar-restaurar type="delete" :value="$clientes" route="clientes.destroy" method="DELETE"
        message="Desactivar" />
    <x-modals.modal-eliminar-restaurar type="restore" :value="$clientes" route="clientes-restore" method="PUT"
        message="Restaurar" bgColor="primary" />
    <div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row col-md-12">
                        <div class="form-group position-relative col-md-4">
                            <label for="presupuesto">Presupuesto</label>
                            <input type="checkbox" name="presupuesto" id="presupuesto" data-size="mini">
                        </div>
                        <div class="form-group position-relative col-md-4">
                            <label for="siroc">Siroc</label>
                            <input type="checkbox" name="siroc" id="siroc" data-size="mini">
                        </div>
                        <div class="form-group position-relative col-md-4">
                            <label for="expediente">Expediente</label>
                            <input type="checkbox" name="expediente" id="expediente" data-size="mini">
                        </div>
                    </div>
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo de correo</th>
                                <th>Proceso</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#confirm-delete-btn').click(function() {
            $(this).prop('disabled', true);
        })
        $('#confirm-restore-btn').click(function() {
            $(this).prop('disabled', true);
        })
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#confirm-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugdelete').val(slug)
        })
        $('#confirm-restore').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var slug = button.data('slug')
            var modal = $(this)
            modal.find('.modal-body #slugrestore').val(slug)
        })
        $('#detalle').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            modal.find('.modal-content #id').val(button.data('id'))
            modal.find('.modal-content #presupuesto').bootstrapSwitch("state", button.data('presupuesto') == 1 ?
                true : false)
            modal.find('.modal-content #presupuesto').bootstrapSwitch('readonly', true)
            modal.find('.modal-content #siroc').bootstrapSwitch("state", button.data('siroc') == 1 ? true : false)
            modal.find('.modal-content #siroc').bootstrapSwitch('readonly', true)
            modal.find('.modal-content #expediente').bootstrapSwitch("state", button.data('expediente') == 1 ?
                true : false)
            modal.find('.modal-content #expediente').bootstrapSwitch('readonly', true)

            table = $('#table').DataTable({
                ajax: '/api/correos-clientes/' + button.data('id'),
                retrieve: true,
                paging: false,
                searching: false,
                columns: [{
                        data: 'nombre_completo'
                    },
                    {
                        data: 'correo'
                    },
                    {
                        data: 'tipo_correo'
                    },
                    {
                        data: 'tipo_proceso'
                    },
                ],
                language: {
                    "lengthMenu": "Mostrar MENU registros por página",
                    "zeroRecords": "No se han encontrado registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
            table.destroy();
        })
    </script>
@stop
