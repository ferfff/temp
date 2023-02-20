@extends('adminlte::page')

@section('plugins.Dropzone', true)

@section('title', 'Perfil')

@section('content_header')
    {{ Breadcrumbs::render('perfil.edit', $usuario) }}
@stop

@section('content')
    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="circular--landscape">
                        @if ($img = $usuario->image)
                            <div class="img" style="background-image: url('{{ asset($img) }}');">
                            </div>
                        @else
                            <div class="img" style="background-image: url('{{ asset('img/Silueta.png') }}');">
                            </div>
                        @endif
                    </div>
                    <span class="font-weight-bold">{{ $usuario->name }}</span>
                    <span class="text-black-50">{{ $usuario->email }}</span>
                    <form action="{{ route('perfil-upload') }}" class="dropzone container" id="dropzone" method="POST">
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <form action="{{ route('perfil.update', $usuario->slug) }}" method="POST" id="formulario"
                    autocomplete="off" onsubmit="return checkSubmit();">
                    @csrf
                    @method('PUT')
                    <div class="p-3 py-5">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nombre" value="{{ $usuario->name }}" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                                    placeholder="Apellido Paterno" value="{{ $usuario->apellido_paterno }}"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                                    placeholder="Apellido Materno" value="{{ $usuario->apellido_materno }}"
                                    style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                    value="{{ $usuario->email }}" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <input type="text" name="phone_number" id="phone_number" class="form-control"
                                    placeholder="Telefono" value="{{ $usuario->phone_number }}">
                            </div>
                        </div>
                        <div class="box-footer mt20">
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="enviar">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="{{ route('perfil-password', $usuario->slug) }}" method="post" id="formulario-contraseña">
        @csrf
        @method('PUT')
        <div class="container rounded bg-white mt-5">
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Contraseña Actual">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="new_password" class="form-control" id="contraseña"
                                placeholder="Nueva Contraseña">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirmar Contraseña" id="confirm_password">
                        </div>
                    </div>
                    <div class="box-footer mt20">
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="enviar-contraseña">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="confirm-agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> Perfil </div>
                <div class="modal-body">
                    <label>¿Deseas actualizar tu información de perfil?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary danger" id="button">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-contraseña" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> Perfil </div>
                <div class="modal-body">
                    <label>¿Deseas actualizar tu información de perfil?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary danger" id="button-contraseña">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .circular--landscape {
            display: inline-block;
            position: relative;
            width: 200px;
            height: 200px;
            overflow: hidden;
            border-radius: 50%;
        }

        .circular--landscape .img {
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@stop

@section('js')
    <script>
        $("#enviar").on("click", function(e) {
            if ($('#formulario').valid()) {
                $("#confirm-agregar").modal("show");
            }
        });
        $("#enviar-contraseña").on("click", function(e) {
            if ($('#formulario-contraseña').valid()) {
                $("#confirm-contraseña").modal("show");
            }
        });
        $("#button-contraseña").click(function() {
            $("#formulario-contraseña").submit();
        });
        $.validator.addMethod("strong_password", function(value, element) {
            let password = value;
            if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,30}$)/.test(password))) {
                return false;
            }
            return true;
        }, function(value, element) {
            let password = $(element).val();
            if (!(/^(.{8,30}$)/.test(password))) {
                return 'La contraseña debe tener entre 8 y 30 caracteres.';
            } else if (!(/^(?=.*[A-Z])/.test(password))) {
                return 'La contraseña debe contener al menos una mayúscula.';
            } else if (!(/^(?=.*[a-z])/.test(password))) {
                return 'La contraseña debe contener al menos una minúscula.';
            } else if (!(/^(?=.*[0-9])/.test(password))) {
                return 'La contraseña debe contener al menos un dígito.';
            } else if (!(/^(?=.*[@#$%&])/.test(password))) {
                return "La contraseña debe contener caracteres especiales de @#$%&.";
            }
        });
        $.validator.addMethod("isEmail", function(value, element) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test($(element).val());
        }, function(value, element) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($(element).val())) {
                return 'El correo es incorrecto'
            }
        });
        $('#formulario').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 20
                },
                apellido_paterno: {
                    maxlength: 20
                },
                apellido_materno: {
                    maxlength: 20
                },
                email: {
                    required: true,
                    isEmail: true,
                    maxlength: 50,
                },
                phone_number: {
                    required: true,
                    maxlength: 10,
                    number: true
                },
            },
        });
        $('#formulario-contraseña').validate({
            rules: {
                password: {
                    required: true,
                },
                new_password: {
                    strong_password: true,
                },
                confirm_password: {
                    equalTo: "#contraseña",
                },
            }
        })
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
    </script>
@stop
