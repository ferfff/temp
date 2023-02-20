<div class="row col-md-12">
    <div id="divFolio"class="col-md-4">
        <div class="form-group position-relative">
            {{ Form::label('folio') }}
            {{ Form::text('folio', $siroc->folio, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
        </div>
    </div>
    <div id="divCliente" class="col-md-4">
        <div class="form-group position-relative">
            {{ Form::label('cliente') }}
            {{ Form::text('cliente_id', $siroc->cliente->razon_social ?? '', ['class' => 'form-control', 'placeholder' => 'Cliente', 'id' => 'cliente_id']) }}
        </div>
    </div>
    <div class="form-group position-relative col-md-4">
        {{ Form::label('imss') }}
        {{ Form::text('imss', $siroc->imss, ['class' => 'form-control', 'placeholder' => 'imss']) }}
    </div>
</div>
<div class="row col-md-12">
    <div class="form-group position-relative col-md-6">
        {{ Form::label('descripcion') }}
        {{ Form::textarea('descripcion', $siroc->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripcion']) }}
    </div>
    <div class="form-group position-relative col-md-6">
        {{ Form::label('archivo') }}
        {{ Form::file('archivo', ['class' => 'form-control', 'accept' => 'application/pdf,image/png,image/jpeg,.xlsx,.docx,.pptx']) }}
    </div>
</div>

<div class="row col-md-12">
    <div class="form-group position-relative col-md-6">
        <div class="form-group position-relative">
            {{ Form::label('fecha_firma_y_siroc') }}
            {{ Form::date('fecha_firma', $siroc->fecha_firma ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control', 'id' => 'fecha_firma']) }}
        </div>
    </div>
    <div class="form-group position-relative col-md-6">
        <div class="form-group position-relative">
            {{ Form::label('fecha_cierre_siroc') }}
            {{ Form::date('fecha_cierre_siroc', $siroc->fecha_cierre_siroc ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control']) }}
        </div>
    </div>
</div>
