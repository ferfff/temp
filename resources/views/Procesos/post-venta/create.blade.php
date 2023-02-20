@extends('adminlte::page')

@section('title', 'Post Venta')

@section('content_header')
    {{ Breadcrumbs::render('post-ventas.store') }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Post Venta</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post-ventas.store') }}" role="form"
                            enctype="multipart/form-data">
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    @csrf
                                    @include('Procesos.post-venta.form')
                                    <div class="form-group">
                                        {{ Form::label('archivo') }}
                                        {{ Form::file('archivo', $postVenta->archivo, ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
                                        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('post-ventas.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
