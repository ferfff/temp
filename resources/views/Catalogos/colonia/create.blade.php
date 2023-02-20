@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Colonia')

@section('content_header')
    {{ Breadcrumbs::render('colonia.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Colonia</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('colonias.store') }}" role="form"
                            enctype="multipart/form-data" id="formulario-colonia" autocomplete="off">
                            @csrf
                            @include('Catalogos.colonia.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-colonia" />
@stop

@section('js')
    <script>
        $("#button-colonia").click(function() {
            //$("#formulario-presupuesto").submit();
            $("#button-colonia").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('nombre', $("#nombre").val());
            formData.append('tipo_asentamiento', $("#tipo_asentamiento").val());
            formData.append('codigo_postal_id', $("#codigo_postal_id").val());
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('colonias.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-colonia").prop('disabled', false);
                    window.location.href = "{{ route('colonias.index') }}"
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
                    $("#button-colonia").prop('disabled', false);
                }
            });
        });
        $("#enviar-colonia").on("click", function(e) {
            if ($('#formulario-colonia').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('.select').select2({
            width: '100%',
        });
        $('#formulario-colonia').validate({
            rules: {
                nombre: {
                    required: true
                },
                tipo_asentamiento: {
                    required: true
                },
                codigo_postal_id: {
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
