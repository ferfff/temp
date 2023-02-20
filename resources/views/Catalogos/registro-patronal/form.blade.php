<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('razon_social') }}
                    {{ Form::text('razon_social', $registroPatronal->razon_social, ['class' => 'form-control' . ($errors->has('razon_social') ? ' is-invalid' : ''), 'placeholder' => 'Razon Social']) }}
                    {!! $errors->first('razon_social', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('razon_comercial') }}
                    {{ Form::text('razon_comercial', $registroPatronal->razon_comercial, ['class' => 'form-control' . ($errors->has('razon_comercial') ? ' is-invalid' : ''), 'placeholder' => 'Razon Comercial']) }}
                    {!! $errors->first('razon_comercial', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('RFC') }}
                    {{ Form::text('RFC', $registroPatronal->RFC, ['class' => 'form-control' . ($errors->has('RFC') ? ' is-invalid' : ''), 'placeholder' => 'Rfc']) }}
                    {!! $errors->first('RFC', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('registro_patronal_imss') }}
                    {{ Form::text('registro_patronal_imss', $registroPatronal->registro_patronal_imss, ['class' => 'form-control' . ($errors->has('registro_patronal_imss') ? ' is-invalid' : ''), 'placeholder' => 'Registro Patronal Imss']) }}
                    {!! $errors->first('registro_patronal_imss', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('logotipo') }}
                    {{ Form::file('logotipo', ['class' => 'form-control' . ($errors->has('logotipo') ? ' is-invalid' : ''), 'accept' => 'image/png, image/jpg']) }}
                    {!! $errors->first('logotipo', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar">
            Guardar
        </button>
        <a href="{{ route('registros-patronales.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
