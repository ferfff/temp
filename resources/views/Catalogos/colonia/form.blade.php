<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group position-relative">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $colonia->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('tipo_asentamiento') }}
            {{ Form::text('tipo_asentamiento', $colonia->tipo_asentamiento, ['class' => 'form-control', 'placeholder' => 'Tipo Asentamiento']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('codigo_postal_id') }}
            {{ Form::select('codigo_postal_id', $codigosPostales, $colonia->codigo_postal_id, ['class' => 'form-control select']) }}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar-colonia">
            Guardar
        </button>
        <a href="{{ route('colonias.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
