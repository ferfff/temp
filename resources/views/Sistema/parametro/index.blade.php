@extends('adminlte::page')

@section('plugins.Numeral', true)
@section('plugins.Select2', true)
@section('plugins.TagEditor', true)
@section('plugins.Switch', true)

@section('title', 'Parametros')

@section('content_header')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <h1>Parametros</h1>
            </div>
            <div class="col-md-3">{{ Breadcrumbs::render('parametros.index') }}</div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            @include('Sistema.parametro.form-titulo')

            @include('Sistema.parametro.form-host')

            @include('Sistema.parametro.form-correo')

            @include('Sistema.parametro.form-whatsapp')

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                @include('Sistema.parametro.form-documento')
                            </div>
                            <div class="col-md-6">
                                @include('Sistema.parametro.form-iva')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @include('Sistema.parametro.form-proceso')
                    </div>
                </div>
            </div>
        </div>
        <x-modals.confirm text="Editar" idModal="confirm-titulo" idButton="button-titulo" />
        <x-modals.confirm text="Editar" idModal="confirm-host" idButton="button-host" />
        <x-modals.confirm text="Editar" idModal="confirm-smtp" idButton="button-smtp" />
        <x-modals.confirm text="Editar" idModal="confirm-whatsapp" idButton="button-whatsapp" />
        <x-modals.confirm text="Editar" idModal="confirm-enviar" idButton="button-enviar" />
        <x-modals.confirm text="Editar" idModal="confirm-dias" idButton="button-dias" />
        <x-modals.confirm text="Editar" idModal="confirm-documentos" idButton="button-documentos" />
        <x-modals.confirm text="Editar" idModal="confirm-procesos" idButton="button-procesos" />
        <x-modals.confirm text="Editar" idModal="confirm-iva" idButton="button-iva" />
    @stop

    @section('css')
        <style>
            #toast-container>.toast-warning {
                color: black;
            }
        </style>
    @stop

    @section('js')
        <script>
            $(document).ready(function() {
                $('#iva').val(numeral($('#iva').val() / 100).format('0.0%'))
                if ($('#dominio_alta_presupuesto').val().length == 0) {
                    $('#dominio_alta').hide()
                }
                if ($('#dominio_modificado_presupuesto').val().length == 0) {
                    $('#dominio_modificado').hide()
                }
                if ($('#dominio_autorizado_presupuesto').val().length == 0) {
                    $('#dominio_autorizado').hide()
                }
                if ($('#dominio_rechazado_presupuesto').val().length == 0) {
                    $('#dominio_rechazado').hide()
                }
                if ($('#dominio_siroc').val().length == 0) {
                    $('#dominio_sir').hide()
                }
                if ($('#dominio_jornales').val().length == 0) {
                    $('#dominio_jor').hide()
                }
                if ($('#dominio_estimaciones').val().length == 0) {
                    $('#dominio_est').hide()
                }
                if ($('#dominio_estimaciones_cliente').val().length == 0) {
                    $('#dominio_est_cli').hide()
                }
                if ($('#dominio_estimaciones_pendiente').val().length == 0) {
                    $('#dominio_est_pen').hide()
                }
                if ($('#dominio_expedientes').val().length == 0) {
                    $('#dominio_exp').hide()
                }
            })
            document.querySelector('#iva').addEventListener('change', (e) => {
                e.target.value = numeral(e.target.value / 100).format('0.0%')
            })
            $('#email_ssl').bootstrapSwitch({
                onText: 'Si',
                offText: 'No',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
            });
            $('#proceso_alta_presupuesto_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_alta').hide()
                        $('#dominio_alta_presupuesto').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_alta').show()
                }
            });
            $('#proceso_modificado_presupuesto_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_modificado').hide()
                        $('#dominio_modificado_presupuesto').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_modificado').show()
                }
            });
            $('#proceso_rechazado_presupuesto_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_rechazado').hide()
                        $('#dominio_rechazado_presupuesto').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_rechazado').show()
                }
            });
            $('#proceso_autorizado_presupuesto_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_autorizado').hide()
                        $('#dominio_autorizado_presupuesto').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_autorizado').show()
                }
            });
            $('#proceso_siroc_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_sir').hide()
                        $('#dominio_siroc').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_sir').show()
                }
            });
            $('#proceso_jornales_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_jor').hide()
                        $('#dominio_jornales').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_jor').show()
                }
            });
            $('#proceso_estimaciones_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_est').hide()
                        $('#dominio_estimaciones').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_est').show()
                }
            });
            $('#proceso_estimaciones_cliente_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_est_cli').hide()
                        $('#dominio_estimaciones_cliente').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_est_cli').show()
                }
            });
            $('#proceso_estimaciones_pendiente_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_est_pen').hide()
                        $('#dominio_estimaciones_pendiente').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_est_pen').show()
                }
            });
            $('#proceso_expedientes_uso').bootstrapSwitch({
                onText: 'Interno',
                offText: 'Externo',
                labelWidth: 10,
                handleWidth: 100,
                size: 'small',
                onSwitchChange: function(e, state) {
                    if (state == false) {
                        $('#dominio_exp').hide()
                        $('#dominio_expedientes').next('.tag-editor').find('.tag-editor-delete').click();
                    } else
                        $('#dominio_exp').show()
                }
            });
            $('#dominio_alta_presupuesto').tagEditor();
            $('#dominio_modificado_presupuesto').tagEditor();
            $('#dominio_autorizado_presupuesto').tagEditor();
            $('#dominio_rechazado_presupuesto').tagEditor();
            $('#dominio_siroc').tagEditor();
            $('#dominio_jornales').tagEditor();
            $('#dominio_estimaciones').tagEditor();
            $('#dominio_estimaciones_cliente').tagEditor();
            $('#dominio_estimaciones_pendiente').tagEditor();
            $('#dominio_expedientes').tagEditor();
            $('#presupuesto').select2({
                width: '100%'
            });
            $('#siroc').select2({
                width: '100%'
            });
            $("#enviar-iva").on("click", function(e) {
                if ($('#formulario-iva').valid()) {
                    $("#confirm-iva").modal("show");
                }
            });
            $("#button-iva").click(function() {
                $("#button-iva").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        iva: $("#iva").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-iva").modal("hide")
                        $("#button-iva").prop('disabled', false);
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
                        $("#button-iva").prop('disabled', false);
                    }
                });
            });
            $("#button-documentos").click(function() {
                $("#button-documentos").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        presupuesto: $("#presupuesto").val(),
                        siroc: $("#siroc").val(),
                        contrato: $("#contrato").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-documentos").modal("hide")
                        $("#button-documentos").prop('disabled', false);
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
                        $("#button-documentos").prop('disabled', false);
                    }
                });
            });
            $("#enviar-documentos").on("click", function(e) {
                if ($('#formulario-documentos').valid()) {
                    $("#confirm-documentos").modal("show");
                }
            });
            $("#button-titulo").click(function() {
                $("#button-titulo").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        titulo: $("#titulo").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-titulo").modal("hide")
                        $("#button-titulo").prop('disabled', false);
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
                        $("#button-titulo").prop('disabled', false);
                    }
                });
            });
            $("#enviar-titulo").on("click", function(e) {
                if ($('#formulario-titulo').valid()) {
                    $("#confirm-titulo").modal("show");
                }
            });
            $("#button-procesos").click(function() {
                $("#button-procesos").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        proceso_alta_presupuesto_uso: $("#proceso_alta_presupuesto_uso").bootstrapSwitch(
                            'state'),
                        dominio_alta_presupuesto: $("#dominio_alta_presupuesto").val(),
                        proceso_autorizado_presupuesto_uso: $("#proceso_autorizado_presupuesto_uso")
                            .bootstrapSwitch('state'),
                        dominio_autorizado_presupuesto: $("#dominio_autorizado_presupuesto").val(),
                        proceso_rechazado_presupuesto_uso: $("#proceso_rechazado_presupuesto_uso")
                            .bootstrapSwitch('state'),
                        dominio_rechazado_presupuesto: $("#dominio_rechazado_presupuesto").val(),
                        proceso_modificado_presupuesto_uso: $("#proceso_modificado_presupuesto_uso")
                            .bootstrapSwitch('state'),
                        dominio_modificado_presupuesto: $("#dominio_modificado_presupuesto").val(),
                        proceso_siroc_uso: $("#proceso_siroc_uso").bootstrapSwitch('state'),
                        dominio_siroc: $("#dominio_siroc").val(),
                        proceso_jornales_uso: $("#proceso_jornales_uso").bootstrapSwitch('state'),
                        dominio_jornales: $("#dominio_jornales").val(),
                        proceso_estimaciones_uso: $("#proceso_estimaciones_uso").bootstrapSwitch('state'),
                        dominio_estimaciones: $("#dominio_estimaciones").val(),
                        proceso_estimaciones_cliente_uso: $("#proceso_estimaciones_cliente_uso")
                            .bootstrapSwitch('state'),
                        dominio_estimaciones_cliente: $("#dominio_estimaciones_cliente").val(),
                        proceso_estimaciones_pendiente_uso: $("#proceso_estimaciones_pendiente_uso")
                            .bootstrapSwitch('state'),
                        dominio_estimaciones_pendiente: $("#dominio_estimaciones_pendiente").val(),
                        proceso_expedientes_uso: $("#proceso_expedientes_uso").bootstrapSwitch('state'),
                        dominio_expedientes: $("#dominio_expedientes").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-procesos").modal("hide")
                        $("#button-procesos").prop('disabled', false);
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
                        $("#button-procesos").prop('disabled', false);
                    }
                });
            });
            $("#enviar-procesos").on("click", function(e) {
                if ($('#formulario-procesos').valid()) {
                    $("#confirm-procesos").modal("show");
                }
            });
            $("#button-host").click(function() {
                $("#button-host").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        host_app: $("#host_app").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro Modificado')
                        toastr.info('Recarge la pagina para que se apliquen lo cambios')
                        $("#confirm-host").modal("hide")
                        $("#button-host").prop('disabled', false);
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
                        $("#button-host").prop('disabled', false);
                    }
                });
            });
            $("#enviar-host").on("click", function(e) {
                if ($('#formulario-host').valid()) {
                    $("#confirm-host").modal("show");
                }
            });

            $("#button-smtp").click(function() {
                $("#button-smtp").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        email_smtp: $("#email_smtp").val(),
                        email_cuenta: $("#email_cuenta").val(),
                        email_password: $("#email_password").val(),
                        email_ssl: $("#email_ssl").bootstrapSwitch('state'),
                        email_puerto: $("#email_puerto").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-smtp").modal("hide")
                        $("#button-smtp").prop('disabled', false);
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
                        $("#button-smtp").prop('disabled', false);
                    }
                });
            });
            $("#enviar-smtp").on("click", function(e) {
                if ($('#formulario-smtp').valid()) {
                    $("#confirm-smtp").modal("show");
                }
            });
            $("#buttonSmtpPrueba").click(function() {
                $("#buttonSmtpPrueba").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "GET",
                    url: "{{ route('correos') }}",
                    dataType: 'json',
                    data: {
                        correo: $("#correoPrueba").val(),
                    },
                    success: function(event) {
                        toastr.success('Correo Enviado')
                        $("#buttonSmtpPrueba").prop('disabled', false);
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
                        $("#buttonSmtpPrueba").prop('disabled', false);
                    }
                });
            });
            $("#button-whatsapp").click(function() {
                $("#button-whatsapp").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        whatsapp_api_key: $("#whatsapp_api_key").val(),
                        whatsapp_api_secret: $("#whatsapp_api_secret").val(),
                        whatsapp_account: $("#whatsapp_account").val(),
                        sms_account: $("#sms_account").val(),
                        medio: $("#medio").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-whatsapp").modal("hide")
                        $("#button-whatsapp").prop('disabled', false);
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
                        $("#button-whatsapp").prop('disabled', false);
                    }
                });
            });
            $("#enviar-whatsapp").on("click", function(e) {
                if ($('#formulario-whatsapp').valid()) {
                    $("#confirm-whatsapp").modal("show");
                }
            });
            $("#button-enviar").click(function() {
                $("#button-enviar").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "POST",
                    url: "{{ route('whatsapp') }}",
                    dataType: 'json',
                    data: {
                        id: $("#uid").val(),
                        destino: $("#destino").val(),
                        mensaje: $("#mensaje").val(),
                    },
                    success: function(event) {
                        toastr.success('Mensaje Enviado')
                        $("#confirm-enviar").modal("hide")
                        $("#button-enviar").prop('disabled', false);
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
                        $("#button-enviar").prop('disabled', false);
                    }
                });
            });
            $("#enviar-enviar").on("click", function(e) {
                if ($('#formulario-enviar').valid()) {
                    $("#confirm-enviar").modal("show");
                }
            });
            $("#button-dias").click(function() {
                $("#button-dias").prop('disabled', true);
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    type: "PUT",
                    url: "{{ route('parametros.update', $parametro) }}",
                    dataType: 'json',
                    data: {
                        whatsapp_dias_valido: $("#whatsapp_dias_valido").val(),
                    },
                    success: function(event) {
                        toastr.success('Registro modificado correctamente')
                        $("#confirm-dias").modal("hide")
                        $("#button-dias").prop('disabled', false);
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
                        $("#button-dias").prop('disabled', false);
                    }
                });
            });
            $("#enviar-dias").on("click", function(e) {
                if ($('#formulario-dias').valid()) {
                    $("#confirm-dias").modal("show");
                }
            });
            $('#formulario-titulo').validate({
                rules: {
                    titulo: {
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
            $('#formulario-host').validate({
                rules: {
                    host_app: {
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
            $('#formulario-smtp').validate({
                rules: {
                    email_smtp: {
                        required: true
                    },
                    email_cuenta: {
                        required: true
                    },
                    email_password: {
                        required: true
                    },
                    email_puerto: {
                        required: true,
                        digits: true
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
            $('#formulario-whatsapp').validate({
                rules: {
                    whatsapp_api_key: {
                        required: true,
                        minlength: 1,
                        maxlength: 50,
                    },
                    whatsapp_api_secret: {
                        required: true,
                        minlength: 1,
                        maxlength: 50,
                    },
                    whatsapp_account: {
                        required: true,
                        maxlength: 10,
                        minlength: 1,
                    },
                    sms_account: {
                        required: true,
                        maxlength: 10,
                        minlength: 1,
                    },
                    medio: {
                        required: true,
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
            $('#formulario-enviar').validate({
                rules: {
                    destino: {
                        required: true,
                        maxlength: 10,
                        minlength: 10,
                        number: true
                    },
                    mensaje: {
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
            $('#formulario-dias').validate({
                rules: {
                    whatsapp_dias_valido: {
                        required: true,
                        number: true,
                        maxlength: 2,
                        minlength: 1,
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
            $('#formulario-documentos').validate({
                rules: {
                    presupuesto: {
                        required: true,
                    },
                    siroc: {
                        required: true,
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
            $('#formulario-procesos').validate({
                rules: {
                    dominio_alta_presupuesto: {
                        required: function(element) {
                            return $("#proceso_alta_presupuesto_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_modificado_presupuesto: {
                        required: function(element) {
                            return $("#proceso_modificado_presupuesto_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_autorizado_presupuesto: {
                        required: function(element) {
                            return $("#proceso_autorizado_presupuesto_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_rechazado_presupuesto: {
                        required: function(element) {
                            return $("#proceso_rechazado_presupuesto_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_siroc: {
                        required: function(element) {
                            return $("#proceso_siroc_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_jornales: {
                        required: function(element) {
                            return $("#proceso_jornales_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_estimaciones: {
                        required: function(element) {
                            return $("#proceso_estimaciones_uso").bootstrapSwitch('state') == true
                        },
                    },
                    dominio_expedientes: {
                        required: function(element) {
                            return $("#proceso_expedientes_uso").bootstrapSwitch('state') == true
                        },
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
            $('#formulario-iva').validate({
                rules: {
                    iva: {
                        required: true,
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
