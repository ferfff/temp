@extends('adminlte::page')

@section('title', 'Factores')

@section('content_header')
    {{ Breadcrumbs::render('factor.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Factor</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('factores.store') }}" role="form"
                            enctype="multipart/form-data" id="formulario" autocomplete="off"
                            onsubmit="return checkSubmit();">
                            @csrf
                            @include('Catalogos.factor.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modals.confirm text="Agregar" />
@stop

@section('js')
    <script>
        $('#formulario').validate({
            rules: {
                SDI: {
                    required: true,
                    maxlength: 10,
                },
                SD: {
                    required: true,
                    maxlength: 10,
                },
                salario: {
                    required: true,
                    maxlength: 10,
                },
                puntualidad: {
                    required: true,
                    maxlength: 10,
                },
                asistencia: {
                    required: true,
                    maxlength: 10,
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
