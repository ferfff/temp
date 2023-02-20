@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Codigos Postales')

@section('content_header')
    {{ Breadcrumbs::render('codigoPostal.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Codigo Postal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('codigos-postales.store') }}" role="form"
                            enctype="multipart/form-data" id="formulario-cp" autocomplete="off">
                            @csrf
                            @include('Catalogos.codigo-postal.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-cp" />
@stop

@section('js')
    <script>
        $("#button-cp").click(function() {
            //$("#formulario-presupuesto").submit();
            $("#button-cp").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('CP', $("#CP").val());
            formData.append('municipio_id', $("#municipio").val());
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('codigos-postales.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-cp").prop('disabled', false);
                    window.location.href = "{{ route('codigos-postales.index') }}"
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
                    $("#button-cp").prop('disabled', false);
                }
            });
        });
        $("#enviar-cp").on("click", function(e) {
            if ($('#formulario-cp').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('.select').select2({
            width: '100%',
        });
        $('#formulario-cp').validate({
            rules: {
                CP: {
                    required: true,
                    digits: true
                },
                municipio_id: {
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
