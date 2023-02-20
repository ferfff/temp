<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Envio de Mensajes</span>
    </div>
    <div class="card-body">
        <div class="row col-md-12">
            <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" role="form"
                enctype="multipart/form-data" id="formulario-whatsapp" class="col-md-4" autocomplete="off">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group position-relative">
                    {{ Form::label('whatsapp_api_key') }}
                    {{ Form::text('whatsapp_api_key', $parametro->whatsapp_api_key, ['class' => 'form-control' . ($errors->has('whatsapp_api_key') ? ' is-invalid' : ''), 'placeholder' => 'Whatsapp Api Key']) }}
                    {!! $errors->first('whatsapp_api_key', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('whatsapp_api_secret') }}
                    <input type="password" name="whatsapp_api_secret"
                        class="form-control{{ $errors->has('whatsapp_api_secret') ? ' is-invalid' : '' }}"
                        id="whatsapp_api_secret" placeholder="Whatsapp Api Key"
                        value="{{ $parametro->whatsapp_api_secret }}">
                    {!! $errors->first('whatsapp_api_secret', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('whatsapp_account') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">+1</span>
                        </div>
                        {{ Form::text('whatsapp_account', $parametro->whatsapp_account, ['class' => 'form-control' . ($errors->has('whatsapp_account') ? ' is-invalid' : ''), 'placeholder' => 'Whatsapp Account']) }}
                    </div>
                    {!! $errors->first('whatsapp_account', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    {{ Form::label('sms_account') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">+1</span>
                        </div>
                        {{ Form::text('sms_account', $parametro->sms_account, ['class' => 'form-control' . ($errors->has('sms_account') ? ' is-invalid' : ''), 'placeholder' => 'Sms Account']) }}
                    </div>
                    {!! $errors->first('sms_account', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <div class="form-group position-relative">
                    <label for="medio">Medio</label>
                    <select name="medio" id="medio" class="form-control">
                        <option value=""></option>
                        <option value="Whatsapp" {{ $parametro->medio == 'Whatsapp' ? 'selected' : '' }}>
                            Whatsapp
                        </option>
                        <option value="SMS" {{ $parametro->medio == 'SMS' ? 'selected' : '' }}>SMS</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-whatsapp">
                    Guardar
                </button>
            </form>
            <form class="col-md-4" action="{{ route('whatsapp') }}" method="POST" id="formulario-enviar"
                autocomplete="off">
                @csrf
                <h5>Probar Cuenta</h5>
                <div class="form-group">
                    <label for="uid">Message unique ID</label>
                    <input type="text" class="form-control" value="{{ Str::uuid() }}" id="uid"
                        name="id" readonly>
                </div>
                <div class="form-group">
                    <label for="destino">Usuario Destino</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">+521</span>
                        </div>
                        <input type="text" class="form-control" id="destino" name="destino">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea name="mensaje" id="mensaje" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <p>
                    <small>Envia un mensaje de WhatsApp a +1 415 523 8886 con el codigo join image-aid.</small>
                </p>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-enviar">
                    Enviar mensaje
                </button>
            </form>
            <form class="col-md-4" method="POST" action="{{ route('parametros.update', $parametro->id) }}"
                id="formulario-dias" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="form-group position-relative">
                    {{ Form::label('whatsapp_dias_valido') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">#</span>
                        </div>
                        {{ Form::number('whatsapp_dias_valido', $parametro->whatsapp_dias_valido, ['class' => 'form-control' . ($errors->has('whatsapp_dias_valido') ? ' is-invalid' : ''), 'min' => '0', 'max' => '99']) }}
                    </div>
                    {!! $errors->first('whatsapp_dias_valido', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-dias">
                    Guardar
                </button>
            </form>
        </div>
        <p>LAS PRUEBAS SE REALIZARAN CON LOS DATOS QUE ESTEN GUARDADOS</p>
    </div>
</div>
