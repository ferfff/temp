@extends('adminlte::page')

@section('title', 'Jornales')

@section('content_header')
    {{ Breadcrumbs::render('jornal.show', $jornal) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Jornal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('jornales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nss:</strong>
                            {{ $jornal->NSS }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Completo:</strong>
                            {{ $jornal->nombre_completo }}
                        </div>
                        <div class="form-group">
                            <strong>Departamento:</strong>
                            {{ $jornal->departamento }}
                        </div>
                        <div class="form-group">
                            <strong>Curp:</strong>
                            {{ $jornal->curp }}
                        </div>
                        <div class="form-group">
                            <strong>Dias Laborados:</strong>
                            {{ $jornal->dias_laborados }}
                        </div>
                        <div class="form-group">
                            <strong>Sdi:</strong>
                            {{ $jornal->SDI }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
