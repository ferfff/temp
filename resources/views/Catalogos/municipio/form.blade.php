<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group position-relative">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $municipio->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('estado') }}
            {{ Form::select('estado_id', $estados, $municipio->estado_id, ['class' => 'form-control select', 'id' => 'estado']) }}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar-municipio">
            Guardar
        </button>
        <a href="{{ route('municipios.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
