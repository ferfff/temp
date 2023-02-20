<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('xml') }}
                    {{ Form::file('xml', ['class' => 'form-control', 'placeholder' => 'xml', 'id' => 'xml', 'accept' => 'text/xml']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('pdf') }}
                    {{ Form::file('pdf', ['class' => 'form-control', 'placeholder' => 'pdf', 'id' => 'pdf', 'accept' => 'application/pdf']) }}
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('folio') }}
                    {{ Form::text('folio', $notaCredito->folio, ['class' => 'form-control', 'placeholder' => 'Folio']) }}
                    {!! $errors->first('folio', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('cliente') }}
                    {{ Form::text('cliente', $notaCredito->cliente_id, ['class' => 'form-control', 'placeholder' => 'Cliente']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('emisor') }}
                    {{ Form::text('emisor', $notaCredito->emisor, ['class' => 'form-control', 'placeholder' => 'Emisor']) }}
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('fecha') }}
                    {{ Form::datetimeLocal('fecha', $notaCredito->fecha, ['class' => 'form-control', 'placeholder' => 'Fecha']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('monto') }}
                    {{ Form::text('monto', $notaCredito->monto, ['class' => 'form-control', 'placeholder' => 'Monto']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <a class="btn btn-default" href="{{ route('nota-de-credito.index') }}">Cancelar</a>
        <button type="button" class="btn btn-primary" id="enviar-credito">Guardar</button>
    </div>
</div>
