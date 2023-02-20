@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    {{ Breadcrumbs::render('users.update', $usuario) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Usuario</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($usuario, [
                            'route' => ['usuarios.update', $usuario],
                            'method' => 'put',
                            'id' => 'formulario-usuario',
                            'autocomplete' => 'off',
                        ]) !!}
                        <div class="form-group position-relative">
                            <label class="h5">Nombre</label>
                            <input class="form-control" name="name" id="name" value="{{ $usuario->name }}">
                        </div>
                        <div class="form-group position-relative">
                            <label class="h5">Apellido Paterno</label>
                            <input class="form-control" name="apellido_paterno" id="apellido_paterno"
                                value="{{ $usuario->apellido_paterno }}">
                        </div>
                        <div class="form-group position-relative">
                            <label class="h5">Apellido Materno</label>
                            <input class="form-control" name="apellido_materno" id="apellido_materno"
                                value="{{ $usuario->apellido_materno }}">
                        </div>
                        <div class="form-group position-relative">
                            <label class="h5">Email</label>
                            <input class="form-control" name="email" type="text" value="{{ $usuario->email }}"
                                id="email">
                        </div>
                        <h2 class="h5">Lista de roles</h2>
                        @foreach ($roles as $rol)
                            <p>
                                <label>
                                    {{ $rol->name }}
                                    <input type="radio" name="roles" value="{{ $rol->id }}"
                                        {{ $rol->id == $usuario->roles->first()->id ? 'checked' : '' }} id="rol">
                                </label>
                            </p>
                        @endforeach
                        <br>
                        <button type="button" class="btn btn-sm btn-primary" id="enviar-usuario">
                            Guardar
                        </button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-usuario" />
@endsection

@section('js')
    <script>
        $("#button-usuario").click(function() {
            $("#button-usuario").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('usuarios.update', $usuario) }}",
                dataType: 'json',
                data: {
                    name: $("#name").val(),
                    apellido_paterno: $("#apellido_paterno").val(),
                    apellido_materno: $("#apellido_materno").val(),
                    registro_patronal: $("#registro_patronal").val(),
                    email: $("#email").val(),
                    roles: $("input[name='roles']:checked").val()
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-usuario").prop('disabled', false);
                    window.location.href = "{{ route('usuarios.index') }}"
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
                    $("#button-usuario").prop('disabled', false);
                }
            });
        });
        $("#enviar-usuario").on("click", function(e) {
            if ($('#formulario-usuario').valid()) {
                $("#confirm").modal("show");
            }
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
        $('#formulario-usuario').validate({
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
                roles: {
                    required: true
                },
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
        });
    </script>
@stop
