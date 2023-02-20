<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group position-relative">
            {{ Form::label('CP') }}
            {{ Form::text('CP', $codigoPostal->CP, ['class' => 'form-control', 'placeholder' => 'CP']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('municipio') }}
            {{ Form::select('municipio_id', $municipios, $codigoPostal->municipio_id, ['class' => 'form-control select', 'id' => 'municipio']) }}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar-cp">
            Guardar
        </button>
        <a href="{{ route('codigos-postales.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
