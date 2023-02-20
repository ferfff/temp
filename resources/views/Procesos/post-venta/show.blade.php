@extends('layouts.app')

@section('template_title')
    {{ $postVenta->name ?? 'Show Post Venta' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Post Venta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('post-ventas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $postVenta->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Contrato Id:</strong>
                            {{ $postVenta->contrato_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $postVenta->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Recepcion:</strong>
                            {{ $postVenta->fecha_recepcion }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $postVenta->archivo }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $postVenta->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
