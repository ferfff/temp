<div class="row col-md-12">
    <div class="form-group position-relative col-md-3">
        {{ Form::label('folio') }}
        {{ Form::text('folio', $presupuesto->folio, ['class' => 'form-control', 'placeholder' => 'Folio']) }}
    </div>
    <div class="form-group position-relative col-md-3">
        {{ Form::label('cliente') }}
        {{ Form::text('cliente_id', $presupuesto->cliente->razon_social ?? null, ['class' => 'form-control', 'placeholder' => 'Clientes', 'id' => 'cliente_id']) }}
    </div>
    <div class="form-group position-relative col-md-3">
        {{ Form::label('fecha_recepcion') }}
        {{ Form::date('fecha_recepcion', $presupuesto->fecha_recepcion ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control', 'placeholder' => 'Fecha Recepcion']) }}
    </div>
    <div class="form-group position-relative col-md-3">
        {{ Form::label('monto') }}
        {{ Form::text('monto', $presupuesto->monto, ['class' => 'form-control', 'placeholder' => 'Monto']) }}
    </div>
</div>
<div class="row col-md-12">
    <div class="form-group position-relative col-md-6">
        {{ Form::label('descripcion') }}
        {{ Form::textarea('descripcion', $presupuesto->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripcion']) }}
    </div>
    <div class="form-group position-relative col-md-6">
        {{ Form::label('archivo') }}
        {{ Form::file('archivo', ['class' => 'form-control', 'accept' => 'application/pdf,image/png,image/jpeg,.xlsx,.docx,.pptx']) }}
    </div>
</div>
