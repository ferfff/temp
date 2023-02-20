<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Parametros del Host</span>
    </div>
    <div class="card-body">
        <div class="row col-md-8">
            <p>Indique el host donde se alojará la aplicación, esta información servirá a la aplicación para informar
                correctamente de Links a los usuarios</p>
            <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" role="form"
                enctype="multipart/form-data" id="formulario-host" class="col-md-8" autocomplete="off">
                {{ method_field('PATCH') }}
                @csrf
                {{ Form::label('host_app') }}
                <div class="form-group input-group mb-3 position-relative">
                    {{ Form::text('host_app', $parametro->host_app, ['class' => 'form-control' . ($errors->has('host_app') ? ' is-invalid' : ''), 'placeholder' => 'Host App']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">/default</span>
                    </div>
                    {!! $errors->first('host_app', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-host">
                    Guardar
                </button>
            </form>
        </div>
    </div>
</div>
