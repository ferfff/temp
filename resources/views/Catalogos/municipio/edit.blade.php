@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Municipios')

@section('content_header')
    {{ Breadcrumbs::render('municipio.update', $municipio) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Municipio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('municipios.update', $municipio) }}" role="form"
                            enctype="multipart/form-data" id="formulario-municipio" autocomplete="off"
                            onsubmit="return checkSubmit();">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('Catalogos.municipio.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" idButton="button-municipio" />
@stop

@section('js')
    <script>
        $("#button-municipio").click(function() {
            //$("#formulario-presupuesto").submit();
            $("#button-municipio").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('nombre', $("#nombre").val());
            formData.append('estado_id', $("#estado").val());
            formData.append("_method", "PUT");
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('municipios.update', $municipio) }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-municipio").prop('disabled', false);
                    window.location.href = "{{ route('municipios.index') }}"
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
                    $("#button-municipio").prop('disabled', false);
                }
            });
        });
        $("#enviar-municipio").on("click", function(e) {
            if ($('#formulario-municipio').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('.select').select2({
            width: '100%',
        });
        $('#formulario-municipio').validate({
            rules: {
                nombre: {
                    required: true
                },
                estado_id: {
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
