@extends('adminlte::page')

@section('plugins.Dropzone', true)
@section('plugins.Summernote', true)
@section('plugins.ContextMenu', true)

@section('title', 'Plantilla de Correo')

@section('content_header')
    {{ Breadcrumbs::render('plantilla.index') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item col-md-6">
                                <a class="nav-link active" id="custom-tabs-three-plantilla-tab" data-toggle="pill"
                                    href="#custom-tabs-three-plantilla" role="tab"
                                    aria-controls="custom-tabs-three-plantilla" aria-selected="true">Plantilla de Correos
                                </a>
                            </li>
                            <li class="nav-item col-md-6">
                                <a class="nav-link" id="custom-tabs-three-imagen-tab" data-toggle="pill"
                                    href="#custom-tabs-three-imagen" role="tab" aria-controls="custom-tabs-three-imagen"
                                    aria-selected="false">Imagen
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-plantilla" role="tabpanel"
                                aria-labelledby="custom-tabs-three-plantilla-tab">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="correo">Correo</label>
                                        <select name="correo" id="correo" class="form-control">
                                            <option value=""></option>
                                            @foreach ($correos as $correo)
                                                <option value="{{ $correo->id }}"
                                                    {{ $correo->id == $selected ? 'selected' : '' }}>
                                                    {{ $correo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <form action="{{ route('plantilla-correos-update', $correo->first()) }}" method="post"
                                    autocomplete="off" enctype="multipart/form-data" class="context-menu-one"
                                    id="formulario-plantilla">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="position-relative">
                                        <textarea name="plantilla" class="form-control" id="plantilla"></textarea>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm btn-primary w-100"
                                                id="enviar-plantilla">
                                                Guardar
                                            </button>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-imagen" role="tabpanel"
                                aria-labelledby="custom-tabs-three-imagen-tab">
                                <div class="row col-md-12">
                                    <div class="col-md-3">
                                        <img src="{{ asset($img) }}" width="50%">
                                    </div>
                                    <form action="{{ route('plantillaImagen') }}" class="dropzone container col-md-9"
                                        id="dropzone" method="POST">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plantilla de Correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>¿Deseas actualizar el contenido de la plantilla?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="button-plantilla">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $("#button-plantilla").click(function() {
            $("#button-plantilla").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('plantilla-correos-update', $correo->first()) }}",
                dataType: 'json',
                data: {
                    plantilla: $('#plantilla').summernote('code'),
                    id: $("#id").val(),
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-plantilla").prop('disabled', false);
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
                    $("#button-plantilla").prop('disabled', false);
                }
            });
        });
        $("#enviar-plantilla").on("click", function(e) {
            if ($('#formulario-plantilla').valid()) {
                $("#confirm").modal("show");
            }
        });

        $('#plantilla').summernote();
        Dropzone.options.dropzone = {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo",
            acceptedFiles: "image/jpg,image/jpeg,image/png",
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
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        location.reload();
                    }
                });
            }
        };
        $("#correo").on("change", function() {
            if (typeof $(this).val() === 'string' && $(this).val().length === 0) {
                $('#plantilla').summernote('code', '');
                $("#id").val('')
                return
            }
            $.ajax({
                url: "/api/plantilla-correos/" + $(this).val(),
                success: function(response) {
                    $("#id").val($("#correo").val())
                    $('#plantilla').summernote('code', $('<div/>').html(response.correo).text());
                    var menuitems = [];
                    $.each(response.variables.split(','), function(key, value) {
                        menuitems[key] = {
                            name: value,
                            icon: "fas fa-feather-alt",
                        };
                    });
                    $.contextMenu({
                        selector: '.context-menu-one',
                        callback: function(key, value, options) {
                            $("#plantilla").summernote('editor.insertText', value.items[key]
                                .name);
                        },
                        items: menuitems
                    });
                }
            })
        });
        $('#formulario').validate({
            rules: {
                plantilla: {
                    required: true,
                },
            },
            ignore: ".ql-container *",
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
