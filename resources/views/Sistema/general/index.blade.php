@extends('adminlte::page')

@section('title', 'Configuraciones Generales')

@section('content_header')
    {{ Breadcrumbs::render('generales.index') }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            Configuracion General
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <p>Proporcione los datos necesarios para validar las tolerancias para tener los expedientes completos
                    </p>
                    <div class="row col-md-12">
                        <form class="col-md-4" method="POST" action="{{ route('generales.update', $general->id) }}"
                            id="formulario-inicial" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <label>Días para validar Expediente inicial</label>
                            <p>Indique cuantos días se consideran, después del inicio del contrato, alertar sobre un
                                expediente incompleto</p>
                            <div class="form-group position-relative ">
                                <label for="dias_expediente_inicial">Días:</label>
                                <input type="number" class="form-control" name="dias_expediente_inicial"
                                    id="dias_expediente_inicial" value="{{ $general->dias_expediente_inicial }}"
                                    min="0" max="365"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                    style='text-align:right'>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" role="dialog" id="enviar-inicio">
                                Definir Días
                            </button>
                        </form>
                        <form class="col-md-4" method="POST" action="{{ route('generales.update', $general->id) }}"
                            id="formulario-final">
                            @csrf
                            @method('PUT')
                            <label>Días para validar Expediente Final</label>
                            <p>Indique cuantos días se consideran, después de la fecha de término del Contrato. para validar
                                las tolerancias para tener los expedientes completos</p>
                            <div class="form-group position-relative ">
                                <label for="dias_expediente_final">Días:</label>
                                <input type="number" class="form-control" name="dias_expediente_final"
                                    id="dias_expediente_final" value="{{ $general->dias_expediente_final }}" min="0"
                                    max="365" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                    style="text-align: right">
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="enviar-final">
                                Definir Días
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modals.confirm text="Editar" idModal="confirm-inicio" idButton="button-inicial" />
    <x-modals.confirm text="Editar" idModal="confirm-final" idButton="button-final" />
@stop

@section('js')
    <script>
        $("#button-inicial").click(function() {
            $("#button-inicial").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('generales.update', $general->id) }}",
                dataType: 'json',
                data: {
                    dias_expediente_inicial: $("#dias_expediente_inicial").val(),
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm-inicio").modal("hide")
                    $("#button-inicial").prop('disabled', false);
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
                    $("#button-inicial").prop('disabled', false);
                }
            });
        });
        $("#enviar-inicio").on("click", function(e) {
            if ($('#formulario-inicial').valid()) {
                $("#confirm-inicio").modal("show");
            }
        });
        $("#button-final").click(function() {
            $("#button-final").prop('disabled', true);
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('generales.update', $general->id) }}",
                dataType: 'json',
                data: {
                    dias_expediente_final: $("#dias_expediente_final").val(),
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm-final").modal("hide")
                    $("#button-final").prop('disabled', false);
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
                    $("#button-final").prop('disabled', false);
                }
            });
        });
        $("#enviar-final").on("click", function(e) {
            if ($('#formulario-final').valid()) {
                $("#confirm-final").modal("show");
            }
        });
        $('#formulario-inicial').validate({
            rules: {
                dias_expediente_inicial: {
                    required: true,
                    number: true,
                    maxlength: 3,
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
        $('#formulario-final').validate({
            rules: {
                dias_expediente_final: {
                    required: true,
                    number: true,
                    maxlength: 3,
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
    </script>
@stop
