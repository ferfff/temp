@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Switch', true)
@section('plugins.iCheck', true)

@section('title', 'Presupuestos')

@section('content_header')
    {{ Breadcrumbs::render('presupuesto.index') }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Presupuesto') }}
                            </span>
                            @can('presupuestos.store')
                                <div class="float-right">
                                    <a href="{{ route('presupuestos.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        Agregar
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('presupuestos.index') }}" method="GET" autocomplete="off">
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
                                <div class="form-check ml-2">
                                    <div class="icheck-primary">
                                        <input class="form-check-input" type="radio" name="activo" id="exampleRadios1"
                                            value="0" {{ $activo == 0 || $activo == null ? 'checked' : '' }}
                                            onchange="submit()">
                                        <label class="form-check-label" for="exampleRadios1">Todos</label>
                                    </div>
                                </div>
                                <div class="form-check ml-2">
                                    <div class="icheck-success">
                                        <input class="form-check-input" type="radio" name="activo" id="exampleRadios2"
                                            value="1" {{ $activo == 1 ? 'checked' : '' }} onchange="submit()">
                                        <label class="form-check-label" for="exampleRadios2">Aprobados</label>
                                    </div>
                                </div>
                                <div class="form-check ml-2">
                                    <div class="icheck-danger">
                                        <input class="form-check-input" type="radio" name="activo" id="exampleRadios3"
                                            value="2" {{ $activo == 2 ? 'checked' : '' }} onchange="submit()">
                                        <label class="form-check-label" for="exampleRadios3">Rechazados</label>
                                    </div>
                                </div>
                                <div class="form-check ml-2">
                                    <div class="icheck-warning">
                                        <input class="form-check-input" type="radio" name="activo" id="exampleRadios4"
                                            value="3" {{ $activo == 3 ? 'checked' : '' }} onchange="submit()">
                                        <label class="form-check-label" for="exampleRadios4">Revision</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <x-tables.table :headers="[
                            'ID',
                            'Folio',
                            'Cliente',
                            'Monto',
                            'Fecha Recepcion',
                            'Siroc',
                            'Contrato',
                            'Estado',
                            'Acciones',
                        ]" id="presupuestos">
                            @foreach ($presupuestos as $presupuesto)
                                <tr>
                                    <x-tables.td :key="true">{{ $presupuesto->id }}</x-tables.td>
                                    <x-tables.td>{{ $presupuesto->folio }}</x-tables.td>
                                    <x-tables.td>{{ $presupuesto->cliente->razon_social }}</x-tables.td>
                                    <x-tables.td>$ {{ number_format($presupuesto->monto, 2, '.', ',') }}</x-tables.td>
                                    <x-tables.td>
                                        {{ \Carbon\Carbon::parse($presupuesto->fecha_recepcion)->format('d/m/Y') }}
                                    </x-tables.td>
                                    <x-tables.td>
                                        <x-inputs.check :value="$presupuesto->siroc != null" :readonly="true" id="siroc" />
                                    </x-tables.td>
                                    <x-tables.td>
                                        <x-inputs.check :value="$presupuesto->contrato != null" :readonly="true" id="contrato" />
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($presupuesto->estado == 'Aprobado')
                                            <span class="badge rounded-pill bg-success">Aprobado</span>
                                        @elseif ($presupuesto->estado == 'Rechazado')
                                            <span class="badge rounded-pill bg-danger">Rechazado</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Revision</span>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        <x-buttons.dropdown :value="$presupuesto" route="presupuestos" :editar="$presupuesto->estado != 'Aprobado'"
                                            :text="$presupuesto->estado == 'Rechazado' ? 'Corregir' : 'Editar'">
                                            <button type="button" class="dropdown-item" id="abrir-archivo"
                                                data-toggle="modal" data-target="#exampleModal"
                                                data-archivo="{{ asset($presupuesto->archivo) }}"
                                                data-descripcion="{{ $presupuesto->descripcion }}">
                                                <i class="fas fa-book"></i> Ver documento
                                            </button>
                                            <a type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#ver-bitacora" data-id="{{ $presupuesto->id }}">
                                                <i class="fas fa-tasks"></i> Bitacora
                                            </a>
                                            @if ($presupuesto->estado != 'Aprobado')
                                                @can('presupuestos.aprobar')
                                                    <a type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#aprobar" data-id="{{ $presupuesto->id }}"
                                                        data-cliente="{{ $presupuesto->cliente_id }}">
                                                        <i class="fas fa-check"></i> Aprobar / Rechazar
                                                    </a>
                                                @endcan
                                            @endif
                                        </x-buttons.dropdown>
                                    </x-tables.td>
                                </tr>
                            @endforeach
                        </x-tables.table>
                        {!! $presupuestos->appends(['buscar' => $buscar, 'activo' => $activo])->links() !!}
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
                    <textarea id="descripcion" class="form-control" readonly></textarea>
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
    <div class="modal fade" id="aprobar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('presupuestos-aprobados', $presupuestos->first()) }}" method="post"
                    id="formulario-ar">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Estado del presupuesto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="presupuesto_id">
                        <input type="hidden" name="cliente" id="cliente">
                        {{ Form::label('¿Aprobar?') }}
                        <input type="checkbox" name="estado" id="estado"
                            class="{{ $errors->has('archivo') ? ' is-invalid' : '' }}" />
                        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <textarea name="comentario" id="comentario-danger" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-ar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-check text-success"></i> Aprobar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres aprobar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button-ar">
                        <i class="fas fa-check text-success"></i> Aprobar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-rechazar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-ban text-danger"></i> Rechazar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Quieres rechazar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button-arr">
                        <i class="fas fa-ban text-danger"></i> Rechazar
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('webviewer/lib/webviewer.min.js') }}"></script>
    <script>
        $("#button-ar").click(function() {
            //$("#formulario-siroc").submit();
            $("#button-ar").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('estado', $("#estado").bootstrapSwitch('state'));
            formData.append('comentario', $("#comentario-danger").val());
            formData.append('cliente', $("#cliente").val());
            formData.append('id', $("#presupuesto_id").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('presupuestos-aprobados', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Aprobado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-ar").prop('disabled', false);
                    window.location.href = "{{ route('presupuestos.index') }}"
                },
                error: function(event) {
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-ar").prop('disabled', false);
                }
            });
        });
        $("#button-arr").click(function() {
            //$("#formulario-siroc").submit();
            $("#button-arr").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('estado', $("#estado").bootstrapSwitch('state'));
            formData.append('comentario', $("#comentario-danger").val());
            formData.append('cliente', $("#cliente").val());
            formData.append('id', $("#presupuesto_id").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('presupuestos-aprobados', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Rechazado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-arr").prop('disabled', false);
                    window.location.href = "{{ route('presupuestos.index') }}"
                },
                error: function(event) {
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-arr").prop('disabled', false);
                }
            });
        });
        $("#enviar-ar").click(function(e) {
            if ($("#estado").bootstrapSwitch('state') == true)
                $("#confirm").modal("show");
            else
                $("#confirm-rechazar").modal("show");
        });
        $("[type='checkbox']").bootstrapSwitch({
            onText: "Si",
            offText: 'No'
        });
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #descripcion').val(button.data('descripcion'))
            WebViewer({
                    path: "{{ asset('WebViewer/lib') }}",
                }, document.getElementById('viewer'))
                .then(instance => {
                    instance.UI.dispose();
                    instance.UI.setLanguage('es');
                    instance.UI.loadDocument(button.data('archivo'));
                });
        })
        $('#aprobar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)

            modal.find('.modal-content #presupuesto_id').val(button.data('id'))
            modal.find('.modal-content #cliente').val(button.data('cliente'))
        })
        table = null
        $('#ver-bitacora').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            table = $('#table').DataTable({
                ajax: '/api/bitacora-presupuesto/' + button.data('id'),
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
