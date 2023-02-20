<div class="card card-default">
    <div class="card-header">
        <span class="card-title">IVA</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" autocomplete="off"
            id="formulario-iva">
            @csrf
            @method('PUT')
            <div class="form-group position-relative">
                {{ Form::label('iva') }}
                {{ Form::text('iva', $parametro->iva, ['class' => 'form-control']) }}
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-iva">
                Guardar
            </button>
        </form>
    </div>
</div>
