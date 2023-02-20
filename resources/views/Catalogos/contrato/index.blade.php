@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Switch', true)
@section('plugins.iCheck', true)
@section('plugins.Dropzone', true)

@section('title', 'Contratos')

@section('content_header')
    {{ Breadcrumbs::render('contrato.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <x-layouts.header title="Contratos" message="Agregar" route="contratos" icon="fas fa-file-signature" />

                <div class="card-body">
                    <form action="{{ route('contratos.index') }}" method="GET" autocomplete="off">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                                aria-describedby="search-addon" name="buscar" value="{{ $buscar }}" />
                            <button type="submit">
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2 mb-2">
                                <x-layouts.fieldset legend="General">
                                    <div class="form-check ml-2">
                                        <div class="icheck-primary">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios1" value="0"
                                                {{ $activo == 0 || $activo == null ? 'checked' : '' }} onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios1">Todos</label>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-success">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios2" value="1" {{ $activo == 1 ? 'checked' : '' }}
                                                onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios2">Activos</label>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-danger">
                                            <input class="form-check-input" type="radio" name="activo"
                                                id="exampleRadios3" value="2" {{ $activo == 2 ? 'checked' : '' }}
                                                onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios3">Inactivos</label>
                                        </div>
                                    </div>
                                </x-layouts.fieldset>
                            </div>
                            <div class="col-md-6 mt-2 mb-2">
                                <x-layouts.fieldset legend="Tipo Contrato">
                                    <div class="form-check ml-2">
                                        <div class="icheck-primary">
                                            <input class="form-check-input" type="radio" name="tipo"
                                                id="exampleRadios4" value="0"
                                                {{ $tipo == 0 || $tipo == null ? 'checked' : '' }} onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios4">Todos</label>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-info">
                                            <input class="form-check-input" type="radio" name="tipo"
                                                id="exampleRadios5" value="1" {{ $tipo == 1 ? 'checked' : '' }}
                                                onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios5">Edificacion</label>
                                        </div>
                                    </div>
                                    <div class="form-check ml-2">
                                        <div class="icheck-info">
                                            <input class="form-check-input" type="radio" name="tipo"
                                                id="exampleRadios6" value="2" {{ $tipo == 2 ? 'checked' : '' }}
                                                onchange="submit()">
                                            <label class="form-check-label" for="exampleRadios6">Urbanizacion</label>
                                        </div>
                                    </div>
                                </x-layouts.fieldset>
                            </div>
                        </div>
                    </form>

                    <x-tables.table :headers="[
                        'Folio',
                        'Cliente',
                        'Tipo de Contrato',
                        'Fecha Firma',
                        'Importe contratado',
                        'Base',
                        'Activo',
                        'Acciones',
                    ]" id="contratos">
                        @forelse ($contratos as $contrato)
                            <x-tables.tr :item="$contrato" :detalle="true" :expandable="true" columns="8">
                                <x-tables.td :key="true">{{ $contrato->folio }}</x-tables.td>
                                <x-tables.td>{{ $contrato->cliente->razon_social }}</x-tables.td>
                                <x-tables.td>{{ $contrato->tipo == 1 ? 'Urbanizacion' : 'Edificacion' }}</x-tables.td>
                                <x-tables.td>{{ date('d/m/Y', strtotime($contrato->fecha_firma)) }}</x-tables.td>
                                <x-tables.td>$ {{ number_format($contrato->importe_contratado, 2, '.', ',') }}
                                </x-tables.td>
                                <x-tables.td>
                                    @if (str_contains($contrato->model_type, 'Presupuesto'))
                                        {{ 'Presupuesto' }}
                                    @else
                                        {{ 'Siroc' }}
                                    @endif
                                </x-tables.td>
                                <x-tables.td>
                                    <x-inputs.check :value="$contrato->deleted_at == null" :readonly="true" />
                                </x-tables.td>
                                <x-tables.td>
                                    <x-buttons.dropdown-eliminar :value="$contrato" route="contratos">
                                        <button class="dropdown-item" id="button-expediente">
                                            <i class="fas fa-folder-open"></i> Expediente
                                        </button>
                                        @if ($contrato->tipo == 1)
                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#exampleModal" data-id="{{ $contrato->uid }}">
                                                <i class="fa fa-fw fa-eye"></i>
                                                Definicion
                                            </button>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('exportar-contrato', $contrato->id) }}">
                                            <i class="fas fa-file-export"></i> Exportar
                                        </a>
                                    </x-buttons.dropdown-eliminar>
                                </x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-layouts.vacio />
                        @endforelse
                    </x-tables.table>
                    {{ $contratos->appends(['buscar' => $buscar, 'activo' => $activo, 'tipo' => $tipo])->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modals.modal-eliminar-restaurar type="delete" :value="$contratos" route="contratos.destroy" method="DELETE"
        message="Desactivar" />
    <x-modals.modal-eliminar-restaurar type="restore" :value="$contratos" route="contratos-restore" method="PUT"
        message="Restaurar" bgColor="primary" />
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Definiciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="table">
                        <thead>
                            <th>Codigo</th>
                            <th>Grupo</th>
                            <th>Clave</th>
                            <th>Partida</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Importe</th>
                        </thead>
                    </table>
                    <form action="{{ route('importar-control_obra') }}" class="dropzone container" id="dropzone"
                        method="POST" enctype="multipart/form-data">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#button-expediente').click(function() {
            console.log($('.content-wrapper'));
            console.log($('.content-wrapper').IFrame('createTab', 'Expedientes',
                "{{ route('expedientes.show', $contrato) }}",
                'Expedientes', true));
            $('.content-wrapper').IFrame('createTab', 'Expedientes', "{{ route('expedientes.show', $contrato) }}",
                'Expedientes', true)
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
        var uid = null
        var definiciones = null
        Dropzone.options.dropzone = {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre un archivo al recuadro para subirlo",
            acceptedFiles: "application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            resizeHeight: 2048,
            maxFiles: 1,
            dictRemoveFile: "Remover Archivo",
            dictMaxFilesExceeded: "No puede Exceder de 10 archivos",
            dictFallbackMessage: "Tu explorador parece desactualizado, no soporta las funcionalidad, intenta con una versión mas actual",
            dictInvalidFileType: "Este tipo de Archivo no esta permitido",
            dictFileTooBig: "Este Archivo es muy grande, máximo permitido: 10 mb por archivo",
            maxFilesize: 10,
            init: function() {
                this.on("complete", function(file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles()
                        .length === 0) {
                        definiciones.ajax.reload();
                    }
                });
                var formData = new FormData();
                this.on("sending", function(file, xhr, formData) {
                    formData.append("uid", uid);
                });
            },
            error: function(file, message, xhr) {
                $(file.previewElement).remove();
            },
        };
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            uid = button.data('id')
            definiciones = $('#table').DataTable({
                ajax: {
                    url: '/api/contrato-control_obra/' + button.data('id')
                },
                processing: true,
                responsive: true,
                autoWidth: false,
                columns: [{
                    data: 'codigo_grupo',
                }, {
                    data: 'grupo',
                }, {
                    data: 'clave',
                }, {
                    data: 'partida',
                }, {
                    data: 'unidad',
                }, {
                    data: 'cantidad',
                }, {
                    data: 'precio_unitario',
                }, {
                    data: 'importe',
                }],
                columnDefs: [{
                    targets: [0, 5, 6, 7],
                    orderable: false,
                    searchable: false
                }, {
                    targets: 6,
                    width: "10%"
                }, {
                    targets: 7,
                    width: "10%"
                }],
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    },
                    'processing': 'Cargando...'
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copiar'
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csvHtml5',
                    'pdfHtml5',
                    {
                        extend: 'colvis',
                        text: 'Visibles'
                    }
                ],
            })
        })
        $('#exampleModal').on('hidden.bs.modal', function(event) {
            definiciones.destroy()
        })
    </script>
@stop
