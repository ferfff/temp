<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Envió de Correo Electrónico</span>
    </div>
    <div class="card-body">
        <div class="row col-md-12">
            <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" role="form"
                enctype="multipart/form-data" id="formulario-smtp" class="col-md-6" autocomplete="off">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group position-relative">
                    {{ Form::label('email_smtp') }}
                    {{ Form::text('email_smtp', $parametro->email_smtp, ['class' => 'form-control' . ($errors->has('email_smtp') ? ' is-invalid' : ''), 'placeholder' => 'Email Smtp']) }}
                    {!! $errors->first('email_smtp', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('email_cuenta') }}
                    {{ Form::text('email_cuenta', $parametro->email_cuenta, ['class' => 'form-control' . ($errors->has('email_cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Email Cuenta']) }}
                    {!! $errors->first('email_cuenta', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('email_password') }}
                    <input type="password" name="email_password" id="email_password"
                        value="{{ $parametro->email_password }}"
                        class="form-control{{ $errors->has('email_password') ? ' is-invalid' : '' }}"
                        placeholder="Email Password">
                    {!! $errors->first('email_password', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('email_ssl') }}
                    {{ Form::checkbox('email_ssl', null, $parametro->email_ssl, ['class' => $errors->has('email_ssl') ? ' is-invalid' : '']) }}
                    {!! $errors->first('email_ssl', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('email_puerto') }}
                    {{ Form::text('email_puerto', $parametro->email_puerto, ['class' => 'form-control' . ($errors->has('email_puerto') ? ' is-invalid' : ''), 'placeholder' => 'Email Puerto']) }}
                    {!! $errors->first('email_puerto', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <p>LAS PRUEBAS SE REALIZARAN CON LOS DATOS QUE ESTEN GUARDADOS</p>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-smtp">
                    Guardar
                </button>
            </form>
            <div class="col-md-6">
                <form action="{{ route('correos') }}" method="GET" class="m-auto" autocomplete="off">
                    <p><strong>Correo Electrónico de Prueba</strong></p>
                    <input type="text" name="correo" id="correoPrueba" class="form-control" required>
                    <p><strong>La prueba se hace con los valores guardados</strong></p>
                    <button type="button" class="btn btn-primary btn-sm mt-2" role="dialog" id="buttonSmtpPrueba">
                        Probar Configuracion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
