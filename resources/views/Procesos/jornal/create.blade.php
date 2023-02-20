@extends('adminlte::page')

@section('title', 'Jornales')

@section('content_header')
    {{ Breadcrumbs::render('jornal.store') }}
@stop

@section('content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Jornal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('jornales.store') }}" role="form"
                            enctype="multipart/form-data" id="formulario" autocomplete="off">
                            @csrf
                            @include('Procesos.jornal.form')
                            <div class="box-footer mt20">
                                <button type="button" class="btn btn-primary" role="dialog" data-bs-toggle="modal"
                                    data-bs-target="#confirm-agregar">Guardar</button>
                            </div>
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
                NSS: {
                    required: true
                },
                nombre_completo: {
                    required: true
                },
                departamento: {
                    required: true
                },
                curp: {
                    required: true
                },
                dias_laborados: {
                    required: true
                },
                SDI: {
                    required: true
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        })
    </script>
@stop
