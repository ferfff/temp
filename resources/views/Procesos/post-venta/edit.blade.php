@extends('adminlte::page')

@section('title', 'Post Venta')

@section('content_header')
    {{ Breadcrumbs::render('post-ventas.update', $postVenta) }}
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Post Venta</span>
                        but
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post-ventas.update', $postVenta->id) }}" role="form"
                            enctype="multipart/form-data">
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    @include('Procesos.post-venta.form')
                                    <div class="form-group">
                                        <label for="archivo">Archivo</label>
                                        <a href="{{ $postVenta->archivo }}" target="_blank" id="archivo">Descargar
                                            Archivo
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('estado') }}
                                        {{ Form::checkbox('estado', null, $postVenta->estado, ['class' => $errors->has('estado') ? ' is-invalid' : '', 'placeholder' => 'Estado']) }}
                                        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
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
@endsection
