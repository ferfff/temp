<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('registro_patronal') }}
                    {{ Form::select('registro_patronal_id', $registros_patronales, $obra->registro_patronal_id, ['class' => 'form-control select' . ($errors->has('registro_patronal_id') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('registro_patronal_id', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('clave_obra') }}
                    {{ Form::text('clave_obra', $obra->clave_obra, ['class' => 'form-control' . ($errors->has('clave_obra') ? ' is-invalid' : ''), 'placeholder' => 'Clave Obra']) }}
                    {!! $errors->first('clave_obra', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group position-relative">
                    {{ Form::label('nombre') }}
                    {{ Form::text('nombre', $obra->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar">
            Guardar
        </button>
        <a href="{{ route('obras.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
