<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Titulos, Logotipo e icono</span>
    </div>
    <div class="card-body">
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Logotipo General</label>
                    <p>Personalice el logotipo de la empresa</p>
                    <p>La imagen debe tener el formato png y tener dimensiones mínimas de:</p>
                    <li><strong>Ancho:</strong>120 pixeles</li>
                    <li><strong>Largo:</strong>50 pixeles</li>
                    <form method="POST" action="{{ route('parametros-logotipo', $parametro->id) }}" role="form"
                        enctype="multipart/form-data" style="overflow:auto;" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <img src="{{ asset($parametro->logotipo) }}" width="70%" alt="Petrea">
                        <input type="file" name="logotipo" onchange="submit()" class="form-control">
                    </form>
                </div>
            </div>
            <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" role="form"
                enctype="multipart/form-data" id="formulario-titulo" class="col-md-4" autocomplete="off">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group position-relative">
                    {{ Form::label('titulo') }}
                    {{ Form::text('titulo', $parametro->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
                    {!! $errors->first('titulo', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
                <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-titulo">
                    Guardar
                </button>
            </form>
            <div class="col-md-4">
                <label>Icono</label>
                <p>Personalice el icono en la pestaña de los exploradores</p>
                <p>La imagen debe tener el formato png y tener:</p>
                <li><strong>Ancho:</strong>48 pixeles</li>
                <li><strong>Largo:</strong>48 pixeles</li>
                <form method="POST" action="{{ route('parametros-icono', $parametro->id) }}" role="form"
                    enctype="multipart/form-data" style="overflow:auto;" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <img src="{{ asset($parametro->icono) }}" alt="icono">
                    <input type="file" name="icono" onchange="submit()" class="form-control">
                </form>
            </div>
        </div>
    </div>
</div>
