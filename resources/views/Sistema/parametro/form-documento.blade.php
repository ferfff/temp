<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Documentos</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" autocomplete="off"
            id="formulario-documentos">
            @csrf
            @method('PUT')
            <div class="form-group position-relative">
                {{ Form::label('presupuesto') }}
                {{ Form::select('presupuesto', $documentos, $parametro->presupuesto, ['class' => 'form-control' . ($errors->has('presupuesto') ? ' is-invalid' : '')]) }}
            </div>
            <div class="form-group position-relative">
                {{ Form::label('Alta Siroc') }}
                {{ Form::select('siroc', $documentos, $parametro->siroc, ['class' => 'form-control' . ($errors->has('siroc') ? ' is-invalid' : ''), 'id' => 'siroc']) }}
            </div>
            <div class="form-group position-relative">
                {{ Form::label('contrato') }}
                {{ Form::select('contrato', $documentos, $parametro->contrato, ['class' => 'form-control' . ($errors->has('contrato') ? ' is-invalid' : ''), 'id' => 'contrato']) }}
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-documentos">
                Guardar
            </button>
        </form>
    </div>
</div>
