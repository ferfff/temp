<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('NSS') }}
                    {{ Form::text('NSS', $jornal->NSS, ['class' => 'form-control' . ($errors->has('NSS') ? ' is-invalid' : ''), 'placeholder' => 'Nss']) }}
                    {!! $errors->first('NSS', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('nombre_completo') }}
                    {{ Form::text('nombre_completo', $jornal->nombre_completo, ['class' => 'form-control' . ($errors->has('nombre_completo') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Completo']) }}
                    {!! $errors->first('nombre_completo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('departamento') }}
                    {{ Form::text('departamento', $jornal->departamento, ['class' => 'form-control' . ($errors->has('departamento') ? ' is-invalid' : ''), 'placeholder' => 'Departamento']) }}
                    {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('curp') }}
                    {{ Form::text('curp', $jornal->curp, ['class' => 'form-control' . ($errors->has('curp') ? ' is-invalid' : ''), 'placeholder' => 'Curp']) }}
                    {!! $errors->first('curp', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('dias_laborados') }}
                    {{ Form::text('dias_laborados', $jornal->dias_laborados, ['class' => 'form-control' . ($errors->has('dias_laborados') ? ' is-invalid' : ''), 'placeholder' => 'Dias Laborados']) }}
                    {!! $errors->first('dias_laborados', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('SDI') }}
                    {{ Form::text('SDI', $jornal->SDI, ['class' => 'form-control' . ($errors->has('SDI') ? ' is-invalid' : ''), 'placeholder' => 'Sdi']) }}
                    {!! $errors->first('SDI', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
