<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group position-relative">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $estado->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('codigo_sat') }}
            {{ Form::text('codigo_sat', $estado->codigo_sat, ['class' => 'form-control', 'placeholder' => 'Codigo Sat']) }}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar-estado">
            Guardar
        </button>
        <a href="{{ route('estados.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
