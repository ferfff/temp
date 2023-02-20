<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('SDI') }}
                    {{ Form::text('SDI', $factor->SDI, ['class' => 'form-control' . ($errors->has('SDI') ? ' is-invalid' : ''), 'placeholder' => 'Sdi', 'maxlength' => 12, 'style' => 'text-align:right']) }}
                    {!! $errors->first('SDI', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('SD') }}
                    {{ Form::text('SD', $factor->SD, ['class' => 'form-control' . ($errors->has('SD') ? ' is-invalid' : ''), 'placeholder' => 'Sd', 'maxlength' => 12, 'style' => 'text-align:right']) }}
                    {!! $errors->first('SD', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('salario') }}
                    {{ Form::text('salario', $factor->salario, ['class' => 'form-control' . ($errors->has('salario') ? ' is-invalid' : ''), 'placeholder' => 'Salario', 'maxlength' => 12, 'style' => 'text-align:right']) }}
                    {!! $errors->first('salario', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('puntualidad') }}
                    {{ Form::text('puntualidad', $factor->puntualidad, ['class' => 'form-control' . ($errors->has('puntualidad') ? ' is-invalid' : ''), 'placeholder' => 'Puntualidad', 'maxlength' => 12, 'style' => 'text-align:right']) }}
                    {!! $errors->first('puntualidad', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('asistencia') }}
                    {{ Form::text('asistencia', $factor->asistencia, ['class' => 'form-control' . ($errors->has('asistencia') ? ' is-invalid' : ''), 'placeholder' => 'Asistencia', 'maxlength' => 12, 'style' => 'text-align:right']) }}
                    {!! $errors->first('asistencia', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar">
            Guardar
        </button>
        <a href="{{ route('factores.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
