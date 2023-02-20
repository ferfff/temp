@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Switch', true)

@section('title', 'Siroc')

@section('content_header')
    {{ Breadcrumbs::render('siroc.index') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Siroc') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('sirocs.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    Agregar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-layouts.buscador route="sirocs" :buscar="$buscar" />
                        <x-tables.table :headers="['ID', 'Folio', 'Cliente', 'Presupuesto', 'Contrato', 'Imss', 'Acciones']" id="presupuestos">
                            @foreach ($sirocs as $siroc)
                                <tr>
                                    <x-tables.td :key="true">{{ $siroc->id }}</x-tables.td>
                                    <x-tables.td>{{ $siroc->folio }}</x-tables.td>
                                    <x-tables.td>{{ $siroc->cliente->razon_social }}</x-tables.td>
                                    <x-tables.td>
                                        <x-inputs.check :value="$siroc->presupuesto != null" :readonly="true" />
                                    </x-tables.td>
                                    <x-tables.td>
                                        <x-inputs.check :value="$siroc->contrato != null" :readonly="true" />
                                    </x-tables.td>
                                    <x-tables.td>{{ $siroc->imss }}</x-tables.td>
                                    <x-tables.td>
                                        <x-buttons.dropdown :value="$siroc" route="sirocs">
                                            <button type="button" class="dropdown-item" id="abrir-archivo"
                                                data-toggle="modal" data-target="#exampleModal"
                                                data-archivo="{{ asset($siroc->archivo) }}">
                                                <i class="fas fa-book"></i> Ver documento
                                            </button>
                                            <a type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#ver-bitacora" data-id="{{ $siroc->id }}">
                                                <i class="fas fa-tasks"></i> Bitacora
                                            </a>
                                        </x-buttons.dropdown>
                                    </x-tables.td>
                                </tr>
                            @endforeach
                        </x-tables.table>
                        {!! $sirocs->appends(['buscar' => $buscar])->links() !!}
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
    <div class="modal fade" id="ver-bitacora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bitacora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Accion</th>
                                <th>Comentario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('webviewer/lib/webviewer.min.js') }}"></script>
    <script>
        $('input[type="checkbox"]').bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
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
        table = null
        $('#ver-bitacora').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            table = $('#table').DataTable({
                ajax: '/api/bitacora-siroc/' + button.data('id'),
                retrieve: true,
                paging: false,
                searching: false,
                columns: [{
                        data: 'user'
                    },
                    {
                        data: 'accion'
                    },
                    {
                        data: 'comentario'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                language: {
                    "lengthMenu": "Mostrar MENU registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
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
        })
        $('#ver-bitacora').on('hidden.bs.modal', function(event) {
            table.destroy();
        })
    </script>
@stop
