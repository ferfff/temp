<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $postVenta->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('contrato') }}
            {{ Form::text('contrato_id', $postVenta->contrato_id, ['class' => 'form-control' . ($errors->has('contrato_id') ? ' is-invalid' : ''), 'placeholder' => 'Contrato']) }}
            {!! $errors->first('contrato_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $postVenta->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('fecha_recepcion') }}
            {{ Form::date('fecha_recepcion', $postVenta->fecha_recepcion, ['class' => 'form-control' . ($errors->has('fecha_recepcion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Recepcion']) }}
            {!! $errors->first('fecha_recepcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
