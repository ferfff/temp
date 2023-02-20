@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Obras')

@section('content_header')
    {{ Breadcrumbs::render('obra.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Obra</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('obras.store') }}" role="form" enctype="multipart/form-data"
                            id="formulario" autocomplete="off" onsubmit="return checkSubmit();">
                            @csrf
                            @include('Catalogos.obra.form')
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
        $('.select').select2({
            width: '100%',
        });
        $('#formulario').validate({
            rules: {
                registro_patronal_id: {
                    required: true
                },
                clave_obra: {
                    required: true,
                    maxlength: 50,
                },
                nombre: {
                    required: true,
                    maxlength: 50,
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
