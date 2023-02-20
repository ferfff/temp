@extends('adminlte::page')

@section('plugins.Summernote', true)
@section('plugins.fileinput', true)
@section('plugins.Datatables', true)
@section('plugins.Webviewer', true)
@section('plugins.JsTree', true)

@section('title', 'Expedientes')

@section('content_header')
    {{ Breadcrumbs::render('expediente.show', $contrato) }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="col-md-10">
                                <h3 class="card_title">
                                    <i class="fas fa-file-signature"></i>
                                    Expedientes: {{ $contrato->folio }} /
                                    <small>{{ $contrato->cliente->razon_social }}</small>
                                </h3>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('contratos.edit', $contrato) }}"
                                    class="btn btn-sm btn-secondary col-md-12">
                                    Regresar
                                </a>
                            </div>
                        </div>
                        <center>
                            <div class="progress progress-sm">
                                @php
                                    $total_obligatorio = round($contrato->documentos_obligatorio / $total_documentos_obligatorios, 2);
                                    $total = $total_obligatorio;
                                @endphp
                                @if ($contrato->documentos_opcionales != 0)
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $contrato->pendientes_obligatorio == 0 ? 'success' : 'warning' }}"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{ $total_obligatorio * 100 }}%"></div>
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                        role="progressbar"
                                        style="width: {{ round($contrato->documentos_opcionales / $total_documentos, 2) * 100 }}%"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                @else
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $contrato->pendientes_obligatorio == 0 ? 'success' : 'warning' }}"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{ $total * 100 }}%"></div>
                                @endif
                            </div>
                            <small>
                                {{ $total * 100 }}% Completo
                            </small>
                        </center>
                    </div>
                    <div class="card-body">
                        @php
                            $pendientes = 0;
                            $vacio = false;
                            foreach ($expedientes as $expediente) {
                                if ($expediente->pendientes > 0) {
                                    $pendientes += 1;
                                }
                                $vacio = $expediente->total == 0 ? true : $vacio;
                            }
                        @endphp
                        <div class="row">
                            @if ($pendientes > 0 || $vacio)
                                <div class="col-md-6">
                                    <x-layouts.vacio text="Expediente Incompleto" type="danger">
                                        Revisa si en alguno de estos documentos te faltan revisar/subir un archivo:
                                        <ul style="columns: 2">
                                            @foreach ($expedientes as $expediente)
                                                @if ($expediente->pendientes > 0 || $expediente->total == 0)
                                                    <li>{{ $expediente->nombre }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </x-layouts.vacio>
                                </div>
                            @endif
                            @if ($contrato->seguimientos > 0)
                                <div class="col-md-6">
                                    <x-layouts.vacio text="Documentos Vencidos" type="warning" :text="'Tienes ' . $contrato->seguimientos . ' documento(s) vencido(s)'">
                                        <ul style="columns: 3">
                                            @foreach ($seguidos as $seguido)
                                                <li>{{ $seguido->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    </x-layouts.vacio>
                                </div>
                            @endif
                        </div>
                        <x-tables.table :headers="[
                            'Documento',
                            'Obligatorio',
                            '¿Solicita Aprobacion?',
                            'Multiple',
                            'Estado',
                            'Acciones',
                        ]">
                            @foreach ($documentos as $documento)
                                <x-tables.tr>
                                    <x-tables.td :key="true">
                                        {{ $documento->documento }}
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($documento->obligatorio)
                                            <span class="badge badge-pill badge-success">Si</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">No</span>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($documento->solicita_aprobacion)
                                            <span class="badge badge-pill badge-success">Si</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">No</span>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($documento->multiple)
                                            <span class="badge badge-pill badge-success">Si</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">No</span>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        @php
                                            $estado_expediente = false;
                                            $grupo = 1;
                                            foreach ($documento->expedientes as $value) {
                                                $estado_expediente = $value->condicion_id == 1 ? true : false;
                                                $grupo = $value->grupo + 1;
                                            }
                                        @endphp
                                        @if ($estado_expediente || (!$documento->obligatorio && !$documento->solicita_aprobacion))
                                            <button class="nav-link btn btn-sm btn-transparent" type="button"
                                                aria-expanded="false" data-toggle="popover" data-trigger="focus"
                                                title="Documentos"
                                                data-content="Tienes {{ $documento->expedientes->where('documento_id', $documento->id)->count() }} documento(s)">
                                                <i class="fas fa-check text-success"></i>
                                                <span class="badge badge-danger navbar-badge">
                                                    {{ $documento->expedientes->where('documento_id', $documento->id)->count() }}
                                                </span>
                                            </button>
                                        @else
                                            <button class="nav-link btn btn-sm btn-transparent" type="button"
                                                aria-expanded="false" data-toggle="popover" data-trigger="focus"
                                                title="Documentos"
                                                data-content="Tienes {{ $documento->expedientes->where('documento_id', $documento->id)->count() }} documento(s)">
                                                <i class="fas fa-times-circle text-danger"></i>
                                                <span class="badge badge-danger navbar-badge">
                                                    {{ $documento->expedientes->where('documento_id', $documento->id)->count() }}
                                                </span>
                                            </button>
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($documento->multiple == 1 || $documento->total == 0)
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-agregar" data-id="{{ $contrato->uid }}"
                                                data-folio="{{ $contrato->folio }}"
                                                data-documento="{{ $documento->uuid }}" data-grupo="{{ $grupo }}">
                                                <i class="fas fa-plus-square"></i>
                                            </button>
                                        @endif
                                        @if ($documento->expedientes->where('documento_id', $documento->id)->count() > 0)
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-ver_documentos"
                                                data-documento_id="{{ $documento->uuid }}"
                                                data-documento="{{ $documento->nombre }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                    </x-tables.td>
                                </x-tables.tr>
                            @endforeach
                        </x-tables.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-ver_documentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelh5">Ver Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <fieldset>
                                    <legend>
                                        <h3 class="h4">Jerarquia de documentos</h3>
                                    </legend>
                                    <div id="jstree_demo_div"></div>
                                </fieldset>
                            </div>
                            <div class="col-md-9">
                                <table id="table-ver_documentos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Grupo</th>
                                            <th>Archivo</th>
                                            <th>Condicion</th>
                                            <th>Comentario</th>
                                            <th>Seguimientos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-Webviewer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="modal-agregar" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar documento {{ $contrato->folio }}</h5>
                    <small> {{ $contrato->cliente->razon_social }}</small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('expedientes.store', $contrato->id) }}" method="POST"
                        enctype="multipart/form-data" class="row col-md-12" id="formulario-crear" autocomplete="off">
                        @csrf
                        <input type="hidden" name="contrato_id" value="{{ $contrato->id }}" id="contrato_id_crear">
                        <input type="hidden" name="documento_id" id="documento_id_crear">
                        <input type="hidden" name="folio" id="folio_crear">
                        <input type="hidden" name="nodo" id="nodo_id">
                        <div class="col-md-6">
                            <p>Comentario:</p>
                            <p>Proporcione la información o instrucciones del recurso proporcionado</p>
                            <div class="form-group position-relative">
                                <textarea name="comentario" class="form-control" id="comentario" value="{{ old('comentario') }}"></textarea>
                            </div>
                            <input type="hidden" name="grupo" id="grupo" value="0">
                        </div>
                        <div class="col-md-6">
                            <div id="divAplazar">
                                <div class="form-group position-relative">
                                    <label for="aplazamiento">Aplazamiento</label>
                                    <input type="date" name="aplazamiento" id="aplazamiento"
                                        value="{{ old('aplazamiento') }}" class="form-control">
                                </div>
                            </div>
                            <div id="divSeguimiento">
                                <div class="form-group position-relative">
                                    <label for="seguimiento">Seguimiento</label>
                                    <input type="date" name="seguimiento" id="seguimiento"
                                        value="{{ old('seguimiento') }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group position-relative">
                                <div class="file-loading">
                                    <input type="file" name="file[]" id="archivo" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-3"> </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary mt-2 w-100" id="enviar-crear">
                                    Guardar
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-secondary mt-2 w-100" data-dismiss="modal">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-cambiar" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('expedientes-cambio') }}" method="POST" id="formulario-cambiar"
                    onsubmit="return checkSubmitCambiar()" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambio en el tipo de documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" value="Recategorizar">
                        <input type="hidden" name="user" value="{{ Auth()->user()->fullname }}">
                        <input type="hidden" name="expediente_id" id="expediente_id">
                        <div class="form-group">
                            <p><b>Seleccione el documento</b></p>
                            <select name="documento_id" id="documento_id_cambio" class="form-control" required>
                                <option value=""></option>
                                @foreach ($documentos as $documento)
                                    <option value="{{ $documento->uuid }}">
                                        {{ $documento->documento }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <input type="text" name="comentario" id="comentario" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-cambio">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-listar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bitacora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <table id="table_listar" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comentario</th>
                                <th>Usuario</th>
                                <th>Accion</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="enviar-cambio">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-danger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('expedientes.update', 1) }}" method="POST" onsubmit="return checkSubmitDanger()"
                    id="formulario-danger">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rechazar Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="condicion_id" id="condicion_id_rechazar" value="2">
                        <input type="hidden" name="accion" id="accion_rechazar" value="Rechazado">
                        <input type="hidden" name="user" value="{{ Auth()->user()->fullname }}"
                            id="user_id_rechazar">
                        <input type="hidden" name="expediente_id" id="expediente_id_rechazar">
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <input type="text" name="comentario" id="comentario-danger" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-danger">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('expedientes.update', 1) }}" method="POST"
                    onsubmit="return checkSubmitSuccess()" id="formulario-success">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aprobar Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="condicion_id" id="condicion_id_aprobar" value="1">
                        <input type="hidden" name="accion" id="accion_aprobar" value="Aprobado">
                        <input type="hidden" name="user" value="{{ Auth()->user()->fullname }}"
                            id="user_id_aprobar">
                        <input type="hidden" name="expediente_id" id="expediente_id_aprobar">
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <input type="text" name="comentario" id="comentario-success" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="enviar-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-descripcion" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descripcion-documento">Descripcion</label>
                        <textarea id="descripcion-documento" class="form-control" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="seguimiento-documento">Fecha de seguimiento</label>
                        <input type="input" name="seguimiento-documento" id="seguimiento-documento"
                            class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_eliminar">
                    <label>¿Quieres eliminar el registro?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="button-eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <x-modals.confirm text="Agregar" idButton="button-crear" />
    <x-modals.confirm text="Editar" idModal="confirm-cambio" idButton="button-cambiar" />
    <x-modals.confirm text="Aprobar" idModal="confirm-success" idButton="button-success" />
    <x-modals.confirm text="Eliminar" idModal="confirm-danger" idButton="button-danger" />
@stop

@section('js')
    <script src="{{ asset('js/multi-modal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script type="text/javascript">
        function checkSubmitCambiar() {
            document.getElementById("button-cambiar").value = "Enviando...";
            document.getElementById("button-cambiar").disabled = true;
            return true;
        }

        function checkSubmitDanger() {
            document.getElementById("button-danger").value = "Enviando...";
            document.getElementById("button-danger").disabled = true;
            return true;
        }

        function checkSubmitSuccess() {
            document.getElementById("button-success").value = "Enviando...";
            document.getElementById("button-success").disabled = true;
            return true;
        }
        $("#button-danger").click(function() {
            $("#button-danger").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('condicion_id', $("#condicion_id_rechazar").val());
            formData.append('accion', $("#accion_rechazar").val());
            formData.append('user', $("#user_id_rechazar").val());
            formData.append('expediente_id', $("#expediente_id_rechazar").val());
            formData.append('comentario', $("#comentario-danger").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('expedientes.update', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm-danger").modal("hide")
                    $("#modal-danger").modal("hide")
                    $("#button-danger").prop('disabled', false);
                    table_ver_documento.ajax.reload()
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-danger").prop('disabled', false);
                }
            });
        });
        $("#enviar-danger").on("click", function(e) {
            $("#confirm-danger").modal("show");
        });
        $("#button-success").click(function() {
            $("#button-success").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('condicion_id', $("#condicion_id_aprobar").val());
            formData.append('accion', $("#accion_aprobar").val());
            formData.append('user', $("#user_id_aprobar").val());
            formData.append('expediente_id', $("#expediente_id_aprobar").val());
            formData.append('comentario', $("#comentario-success").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('expedientes.update', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro modificado con exito.')
                    $("#confirm-success").modal("hide")
                    $("#modal-success").modal("hide")
                    $("#button-success").prop('disabled', false);
                    table_ver_documento.ajax.reload()
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-crear").prop('disabled', false);
                }
            });
        });
        $("#enviar-success").on("click", function(e) {
            $("#confirm-success").modal("show");
        });
        $('#modal-eliminar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #id_eliminar').val(button.data('id'))
        })
        $("#button-eliminar").click(function() {
            $("#button-eliminar").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('expediente_id', $("#id_eliminar").val());
            formData.append("_method", "DELETE");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('expedientes.destroy', 1) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    if (event.seguidos_count > 0) {
                        toastr.warning('Este documento tiene documentos que le pertenecen.')
                    } else {
                        toastr.success('Registro Eliminado con exito.')
                    }
                    $("#modal-eliminar").modal("hide")
                    $("#button-eliminar").prop('disabled', false);
                    table_ver_documento.ajax.reload()
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-eliminar").prop('disabled', false);
                }
            });
        });
        $('#modal-descripcion').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #descripcion-documento').val(button.data('descripcion'))
            modal.find('.modal-content #seguimiento-documento').val(button.data('seguimiento'))
        })
        $('#modal-danger').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #expediente_id_rechazar').val(button.data('id'))
        })
        $('#modal-success').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #expediente_id_aprobar').val(button.data('id'))
        })
        $("#enviar-cambio").on("click", function(e) {
            $("#confirm-cambio").modal("show");
        });
        $("#button-cambiar").click(function() {
            $("#formulario-cambiar").submit();
        });
        $('#modal-cambiar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #expediente_id').val(button.data('id'))
        })
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        $('#modal-Webviewer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            WebViewer({
                    path: "{{ asset('WebViewer/lib') }}",
                }, document.getElementById('viewer'))
                .then(instance => {
                    instance.UI.dispose();
                    instance.UI.setLanguage('es');
                    instance.UI.loadDocument(button.data('id'));
                });
        });
        $('#jstree_demo_div').jstree();
        var documento_id
        var table_ver_documento
        $('#jstree_demo_div').on("select_node.jstree", function(e, data) {
            lst_item = [];
            $('#jstree_demo_div li').each(function() {
                lst_item.push($(this).attr('id'));
            });
            $('#jstree_demo_div').jstree(true).set_icon(lst_item, "far fa-folder");
            $(this).jstree(true).set_icon(data.node.id, "far fa-folder-open");

            table_ver_documento.destroy();
            table_ver_documento = $('#table-ver_documentos').DataTable({
                processing: true,
                searching: false,
                paging: false,
                info: false,
                ajax: {
                    url: "{{ route('table') }}",
                    data: {
                        contrato_id: "{{ $contrato->uid }}",
                        documento_id: documento_id,
                        fecha: data.node.text
                    }
                },
                columns: [{
                        data: 'grupo'
                    },
                    {
                        data: 'ruta',
                        render: function(data, type, full, meta) {
                            icono = ''
                            if (full.extension == 'pdf') {
                                icono = `<i class="fas fa-file-pdf"></i>`
                            }
                            if (full.extension == 'png' || full.extension == 'jpg') {
                                icono = `<i class="fas fa-file-image"></i>`
                            }
                            if (full.extension == 'xlsx') {
                                icono = `<i class="fas fa-file-excel"></i>`
                            }
                            if (full.extension == 'docx') {
                                icono = `<i class="fas fa-file-word"></i>`
                            }
                            if (full.extension == 'pptx') {
                                icono = `<i class="fas fa-file-powerpoint"></i>`
                            }
                            return `<center><a href="#" style="font-size: 75px;" data-toggle="modal"
                                    data-target="#modal-Webviewer" data-id="` + data + `">
                                    ` + icono + `
                                </a></center>`
                        },
                        orderable: false,
                        searching: false,
                    },
                    {
                        data: 'condicion.nombre'
                    },
                    {
                        data: 'comentario',
                        visible: false,
                        render: function(data, type, full, meta) {
                            return $('<td>').html(data).text();
                        }
                    },
                    {
                        data: 'seguimiento',
                        render: function(data, type, full, meta) {
                            if (data != null)
                                return moment(data).format('DD/MM/YYYY')
                            else
                                return '-'
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, full, meta) {
                            content = `<button type="button"class="btn btn-transparent"
                                                    data-toggle="modal" data-target="#modal-cambiar"
                                                    data-id="` + data + `">
                                                    <i class="fas fa-random text-info"></i>
                                                </button>
                                                <button type="button" class="btn btn-transparent"
                                                    data-toggle="modal" data-target="#modal-listar"
                                                    data-id="` + data + `">
                                                    <i class="fas fa-tasks text-info"></i>
                                                </button>
                                                <button type="button" class="btn btn-transparent"
                                                    data-toggle="modal" data-target="#modal-descripcion"
                                                    data-descripcion="` + full.comentario + `"
                                                    data-seguimiento="` + full.seguimiento + `">
                                                    <i class="fas fa-envelope-open-text text-info"></i>
                                                </button>
                                                <button type="button" class="btn btn-transparent"
                                                    data-toggle="modal" data-target="#modal-eliminar"
                                                    data-id="` + data + `">
                                                    <i class="fas fa-trash text-info"></i>
                                                </button>`
                            if (full.seguimiento != null) {
                                content += `<button type="button" class="btn btn-transparent"
                                                    data-toggle="modal" data-target="#modal-agregar"
                                                    data-id="{{ $contrato->uid }}"
                                                    data-folio="{{ $contrato->folio }}"
                                                    data-nodo_id="` + data + `">
                                                <i class="fas fa-plus text-info"></i>
                                                </button>`
                            }
                            if (full.condicion_id != 1) {
                                if (full.condicion_id != 2) {
                                    content += `<button type="button" class="btn btn-transparent"
                                            data-toggle="modal" data-target="#modal-danger"
                                            data-id="` + data + `">
                                            <i class="fas fa-ban text-danger"></i>
                                        </button>
                                        `
                                }
                                content += `<button type="button" class="btn btn-transparent"
                                            data-toggle="modal" data-target="#modal-success"
                                            data-id="` + data + `">
                                            <i class="fas fa-check text-success"></i>
                                        </button>
                                        `
                            }
                            return content
                        },
                        orderable: false,
                        searching: false,
                    }
                ],
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    },
                    'processing': 'Procesando...'
                }
            })
        });
        $('#modal-ver_documentos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            documento_id = button.data('documento_id')
            modal.find('.modal-content #exampleModalLabelh5').text('Ver Documento [' +
                button.data('documento') + ']')
            table_ver_documento = $('#table-ver_documentos').DataTable({
                searching: false,
                paging: false,
                info: false,
                orderable: false,
                language: {
                    "zeroRecords": "Nada encontrado disculpa",
                    "processing": "Procesando..."
                }
            })
            table_ver_documento.clear().draw();
            $.ajax({
                type: "GET",
                url: "{{ route('tree') }}",
                data: {
                    contrato_id: "{{ $contrato->uid }}",
                    documento_id: button.data('documento_id'),
                },
                dataType: "json",
                success: function(json) {
                    json.forEach(element => {
                        if (element.parent == null) {
                            element.parent = '#'
                        }
                        element.icon = 'far fa-folder'
                    });
                    $('#jstree_demo_div').jstree(true).settings.core.data = json;
                    $("#jstree_demo_div").jstree(true).refresh();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        })
        $('#modal-ver_documentos').on('hidden.bs.modal', function(event) {
            table_ver_documento.destroy();
            //location.reload()
        });
        $('#comentario').summernote({
            callbacks: {
                onInit: function(c) {
                    c.editable.html('');
                }
            },
            height: 200,
            tabsize: 2,
        });
        $('#comentario2').summernote({
            callbacks: {
                onInit: function(c) {
                    c.editable.html('');
                }
            },
            height: 200,
            tabsize: 2,
        });
        $("#archivo").fileinput({
            theme: "explorer",
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["pdf", "png", "jpeg", "xlsx", "docx", "pptx"],
            maxFileSize: 5000,
            required: true
        });
        var table_listar
        $('#modal-listar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #id').val(button.data('id'))
            table_listar = $('#table_listar').DataTable({
                ajax: '/api/expediente-bitacora/' + button.data('id'),
                retrieve: true,
                paging: false,
                searching: false,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'comentario'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data: 'accion'
                    },
                    {
                        data: 'created_at'
                    }
                ],
                language: {
                    "lengthMenu": "Mostrar MENU registros por página",
                    "zeroRecords": "Nada encontrado disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            })
        })
        $('#modal-modal-listar').on('hidden.bs.modal', function(event) {
            table_listar.destroy();
        });
        $('#modal-agregar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)
            modal.find('.modal-content #contrato_id_crear').val(button.data('id'))
            modal.find('.modal-content #documento_id_crear').val(button.data('documento'))
            modal.find('.modal-content #grupo').val(button.data('grupo'))
            modal.find('.modal-content #folio_crear').val(button.data('folio'))
            modal.find('.modal-content #nodo_id').val(button.data('nodo_id'))
            $.ajax({
                url: "/api/expediente-aplazamiento_seguimiento/",
                type: "GET",
                dataType: "json",
                data: {
                    documento_id: button.data('documento')
                },
                success: function(data) {
                    if (data.seguimiento == 1) {
                        $("#divSeguimiento").show()
                    } else {
                        $("#divSeguimiento").hide()
                    }
                    if (data.aplazamiento == 1) {
                        $("#divAplazar").show()
                    } else {
                        $("#divAplazar").hide()
                    }
                }
            })
        })
        $("#enviar-crear").on("click", function(e) {
            if ($('#archivo').fileinput('getFilesCount') == 0) {
                toastr.info('Suba un archivo')
            }
            if ($('#formulario-crear').valid()) {
                $("#confirm").modal("show");
            }
        });
        $("#button-crear").click(function() {
            $("#button-crear").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('documento_id', $("#documento_id_crear").val());
            formData.append('contrato_id', $("#contrato_id_crear").val());
            formData.append('folio', $("#folio_crear").val());
            formData.append('comentario', $("#comentario").val());
            formData.append('aplazamiento', $("#aplazamiento").val());
            formData.append('seguimiento', $("#seguimiento").val());
            formData.append('grupo', $("#grupo").val());
            formData.append('nodo_id', $("#nodo_id").val());
            var ins = document.getElementById('archivo').files.length;
            for (var x = 0; x < ins; x++) {
                formData.append("file[]", document.getElementById('archivo').files[x]);
            }
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('expedientes.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-crear").prop('disabled', false);
                    window.location.href = "{{ route('expedientes.show', $contrato) }}"
                },
                error: function(event) {
                    if (event.status == 419) {
                        window.parent.location.href = "{{ route('principal') }}"
                    }
                    if (event.status == 422) {
                        $.each(event.responseJSON.errors, function(i, error) {
                            toastr.warning(error[0])
                        });
                    }
                    $("#button-crear").prop('disabled', false);
                }
            });
        });
        $.validator.addMethod("fecha", function(value, element) {
            if (value.length != 0) {
                var today = new Date()
                var date = new Date(value)
                return date > today
            }
            return true
        }, function(value, element) {
            var today = new Date()
            var date = new Date(value)
            if (!date < today) {
                return 'La fecha no puede ser menor a la actual'
            }
        });
        $('#formulario-crear').validate({
            rules: {
                comentario: {
                    required: true
                },
                seguimiento: {
                    fecha: true
                },
                aplazamiento: {
                    fecha: true
                },
                "file[]": {
                    required: true
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            invalidHandler: function(event, validator) {
                if (validator.numberOfInvalids()) {
                    ion.sound.play("error");
                }
            },
            errorClass: "invalid-tooltip"
        })
    </script>
@stop
