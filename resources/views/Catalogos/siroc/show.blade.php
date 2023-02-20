@extends('layouts.app')

@section('template_title')
    {{ $siroc->name ?? 'Show Siroc' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Siroc</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sirocs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $siroc->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Presupuesto Id:</strong>
                            {{ $siroc->presupuesto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Imms:</strong>
                            {{ $siroc->imms }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Aplazamiento:</strong>
                            {{ $siroc->fecha_aplazamiento }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
