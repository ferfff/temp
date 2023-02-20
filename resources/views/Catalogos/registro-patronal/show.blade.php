@extends('adminlte::page')

@section('title', 'Registros Patronales')

@section('content_header')
    {{ Breadcrumbs::render('registroPatronal.show', $registroPatronal) }}
    <h1>Registros Patronales</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Registro Patronal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('registros-patronales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Razon Social:</strong>
                            {{ $registroPatronal->razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>Razon Comercial:</strong>
                            {{ $registroPatronal->razon_comercial }}
                        </div>
                        <div class="form-group">
                            <strong>Rfc:</strong>
                            {{ $registroPatronal->RFC }}
                        </div>
                        <div class="form-group">
                            <strong>Registro Patronal Imss:</strong>
                            {{ $registroPatronal->registro_patronal_imss }}
                        </div>
                        <div class="form-group">
                            <strong>Logotipo:</strong>
                            {{ $registroPatronal->logotipo }}
                        </div>
                        <div class="form-group">
                            <strong>Folio Obra:</strong>
                            {{ $registroPatronal->folio_obra }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
