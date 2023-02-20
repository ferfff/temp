@extends('adminlte::page')

@section('title', 'Estados')

@section('content_header')
    {{ Breadcrumbs::render('estado.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Estado</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('estados.store') }}" role="form" enctype="multipart/form-data"
                            id="formulario-estado" autocomplete="off">
                            @csrf
                            @include('Catalogos.estado.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" idButton="button-estado" />
@stop

@section('js')
    <script>
        $("#button-estado").click(function() {
            //$("#formulario-presupuesto").submit();
            $("#button-estado").prop('disabled', true);
            event.preventDefault();
            var formData = new FormData();
            formData.append('nombre', $("#nombre").val());
            formData.append('codigo_sat', $("#codigo_sat").val());
            $.ajax({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('estados.store') }}",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(event) {
                    toastr.success('Registro Agregado con exito.')
                    $("#confirm").modal("hide")
                    $("#button-estado").prop('disabled', false);
                    window.location.href = "{{ route('estados.index') }}"
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
                    $("#button-estado").prop('disabled', false);
                }
            });
        });
        $("#enviar-estado").on("click", function(e) {
            if ($('#formulario-estado').valid()) {
                $("#confirm").modal("show");
            }
        });
        $('#formulario-estado').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 5,
                    maxlength: 25
                },
                codigo_sat: {
                    required: true,
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
