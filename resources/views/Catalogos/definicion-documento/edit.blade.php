@extends('adminlte::page')

@section('plugins.Switch', true)

@section('title', 'Definicion de Documentos')

@section('content_header')
    {{ Breadcrumbs::render('definicionDocumentos.update', $definicionDocumento) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Documento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('definicion-documentos.update', $definicionDocumento) }}"
                            role="form" enctype="multipart/form-data" id="formulario-documento" autocomplete="off">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('Catalogos.definicion-documento.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-documento" />
@stop

@section('js')
    <script>
        $("#button-documento").click(function() {
            $("#button-documento").prop('disabled', true);
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "PUT",
                url: "{{ route('definicion-documentos.update', $definicionDocumento) }}",
                dataType: 'json',
                data: {
                    nombre: $("#nombre").val(),
                    obligatorio: $("#obligatorio").bootstrapSwitch('state'),
                    solicita_aprobacion: $("#aprobacion").bootstrapSwitch('state'),
                    solicita_comentario: $("#comentario").bootstrapSwitch('state'),
                    ciclo_id: $("#ciclo_id").val(),
                    multiple: $("#multiple").bootstrapSwitch('state'),
                    referencia: $("#referencia").bootstrapSwitch('state'),
                    seguimiento: $("#seguimiento").bootstrapSwitch('state'),
                    activo: $("#activo").bootstrapSwitch('state'),
                    aplazamiento: $("#aplazamiento").bootstrapSwitch('state'),
                },
                success: function(event) {
                    toastr.success('Registro Modificado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-documento").prop('disabled', false);
                    window.location.href = "{{ route('definicion-documentos.index') }}"
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
                    $("#button-documento").prop('disabled', false);
                }
            })
        });
        $("#enviar-documento").on("click", function(e) {
            if ($('#formulario-documento').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#activo').bootstrapSwitch({
            onText: 'Si',
            offText: 'No',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#obligatorio').bootstrapSwitch({
            onText: 'Obligatorio',
            offText: 'Opcional',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#aprobacion').bootstrapSwitch({
            onText: 'Si, deberá ser aprobado',
            offText: 'No, se aprueba al subirlo',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#comentario').bootstrapSwitch({
            onText: 'Comentario Obligatorio',
            offText: 'Comentario Opcional',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#multiple').bootstrapSwitch({
            onText: 'Si acepta',
            offText: 'No acepta',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#referencia').bootstrapSwitch({
            onText: 'Si solicita',
            offText: 'No solicita',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#seguimiento').bootstrapSwitch({
            onText: 'Si, programa seguimiento',
            offText: 'No',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        $('#aplazamiento').bootstrapSwitch({
            onText: 'Si permite aplazar el termino del contrato',
            offText: 'No genera un aplazamiento de contrato',
            labelWidth: 10,
            handleWidth: 100,
            size: 'small'
        });
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                html: true
            })
        })
        document.addEventListener('DOMContentLoaded', e => {
            for (let checkbox of document.querySelectorAll('input[type=checkbox]')) {
                checkbox.value = checkbox.checked ? 1 : 0;
                checkbox.addEventListener('change', e => {
                    e.target.value = e.target.checked ? 1 : 0;
                });
            }
        });
        $('#formulario-documento').validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 50,
                },
                obligatorio: {
                    range: [0, 1]
                },
                solicita_aprobacion: {
                    range: [0, 1]
                },
                solicita_comentario: {
                    range: [0, 1]
                },
                ciclo_id: {
                    required: true
                },
                multiple: {
                    range: [0, 1]
                },
                referencia: {
                    range: [0, 1]
                },
                seguimiento: {
                    range: [0, 1]
                },
                activo: {
                    range: [0, 1]
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
        })
    </script>
@stop
