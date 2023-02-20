@extends('adminlte::page')

@section('title', 'Registors Patronales')

@section('content_header')
    {{ Breadcrumbs::render('registroPatronal.update', $registroPatronal) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Registro Patronal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('registros-patronales.update', $registroPatronal) }}"
                            role="form" enctype="multipart/form-data" id="formulario" autocomplete="off"
                            onsubmit="return checkSubmit();">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('Catalogos.registro-patronal.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Editar" />
@stop

@section('js')
    <script>
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            },
            "RFC No valido"
        );
        $('#formulario').validate({
            rules: {
                razon_social: {
                    required: true,
                    maxlength: 50,
                },
                razon_comercial: {
                    required: true,
                    maxlength: 50,
                },
                RFC: {
                    required: true,
                    regex: /^([A-ZÑa-zñ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Za-z\d]{3}))$/
                },
                registro_patronal_imss: {
                    required: true,
                    maxlength: 50,
                },
                logotipo: {
                    //required: true
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
