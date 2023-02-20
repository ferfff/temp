@extends('layouts.app')

@section('template_title')
    {{ $presupuesto->name ?? 'Show Presupuesto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Presupuesto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('presupuestos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $presupuesto->cliente->razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $presupuesto->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Recepcion:</strong>
                            {{ $presupuesto->fecha_recepcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@stop
