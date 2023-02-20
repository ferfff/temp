<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Correos</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('parametros.update', $parametro->id) }}" autocomplete="off"
            id="formulario-procesos">
            @csrf
            @method('PUT')
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_alta_presupuesto_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_alta_presupuesto_uso', null, $parametro->dominio_alta_presupuesto != null, ['class' => 'form-control' . ($errors->has('proceso_alta_presupuesto_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_alta_presupuesto_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
                <div id="dominio_alta" class="form-group position-relative">
                    {{ Form::label('dominio_alta_presupuesto') }}
                    {{ Form::text('dominio_alta_presupuesto', $parametro->dominio_alta_presupuesto, ['class' => 'form-control' . ($errors->has('dominio_alta_presupuesto') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('dominio_alta_presupuesto', '<div class="invalid-tooltip">:message</div>') !!}
                </div>
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_modificado_presupuesto_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_modificado_presupuesto_uso', null, $parametro->dominio_modificado_presupuesto != null, ['class' => 'form-control' . ($errors->has('proceso_modificado_presupuesto_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_modificado_presupuesto_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_modificado" class="form-group position-relative">
                {{ Form::label('dominio_modificado_presupuesto') }}
                {{ Form::text('dominio_modificado_presupuesto', $parametro->dominio_modificado_presupuesto, ['class' => 'form-control' . ($errors->has('dominio_modificado_presupuesto') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_modificado_presupuesto', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_autorizado_presupuesto_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_autorizado_presupuesto_uso', null, $parametro->dominio_autorizado_presupuesto != null, ['class' => 'form-control' . ($errors->has('proceso_autorizado_presupuesto_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_autorizado_presupuesto_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_autorizado" class="form-group position-relative">
                {{ Form::label('dominio_autorizado_presupuesto') }}
                {{ Form::text('dominio_autorizado_presupuesto', $parametro->dominio_autorizado_presupuesto, ['class' => 'form-control' . ($errors->has('dominio_autorizado_presupuesto') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_autorizado_presupuesto', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_rechazado_presupuesto_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_rechazado_presupuesto_uso', null, $parametro->dominio_rechazado_presupuesto != null, ['class' => 'form-control' . ($errors->has('proceso_rechazado_presupuesto_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_rechazado_presupuesto_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_rechazado" class="form-group position-relative">
                {{ Form::label('dominio_rechazado_presupuesto') }}
                {{ Form::text('dominio_rechazado_presupuesto', $parametro->dominio_rechazado_presupuesto, ['class' => 'form-control' . ($errors->has('dominio_rechazado_presupuesto') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_rechazado_presupuesto', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_siroc_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_siroc_uso', null, $parametro->dominio_siroc != null, ['class' => 'form-control' . ($errors->has('proceso_siroc_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_siroc_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_sir" class="form-group position-relative">
                {{ Form::label('dominio_siroc') }}
                {{ Form::text('dominio_siroc', $parametro->dominio_siroc, ['class' => 'form-control' . ($errors->has('dominio_siroc') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_siroc', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_jornales_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_jornales_uso', null, $parametro->dominio_jornales != null, ['class' => 'form-control' . ($errors->has('proceso_jornales_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_jornales_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_jor" class="form-group position-relative">
                {{ Form::label('dominio_jornales') }}
                {{ Form::text('dominio_jornales', $parametro->dominio_jornales, ['class' => 'form-control' . ($errors->has('dominio_jornales') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_jornales', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_estimaciones_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_estimaciones_uso', null, $parametro->dominio_estimaciones != null, ['class' => 'form-control' . ($errors->has('proceso_estimaciones_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_estimaciones_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_est" class="form-group position-relative">
                {{ Form::label('dominio_estimaciones') }}
                {{ Form::text('dominio_estimaciones', $parametro->dominio_estimaciones, ['class' => 'form-control' . ($errors->has('dominio_estimaciones') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_estimaciones', '<div class="invalid-tooltip">:message</div>') !!}
            </div>

            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_estimaciones_cliente_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_estimaciones_cliente_uso', null, $parametro->dominio_estimaciones_cliente != null, ['class' => 'form-control' . ($errors->has('dominio_estimaciones_cliente') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_estimaciones_cliente_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_est_cli" class="form-group position-relative">
                {{ Form::label('dominio_estimaciones_cliente') }}
                {{ Form::text('dominio_estimaciones_cliente', $parametro->dominio_estimaciones_cliente, ['class' => 'form-control' . ($errors->has('dominio_expedientes') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_estimaciones_cliente', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_estimaciones_pendiente_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_estimaciones_pendiente_uso', null, $parametro->dominio_estimaciones_pendiente != null, ['class' => 'form-control' . ($errors->has('dominio_estimaciones_cliente') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_estimaciones_pendiente_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_est_pen" class="form-group position-relative">
                {{ Form::label('dominio_estimaciones_pendiente') }}
                {{ Form::text('dominio_estimaciones_pendiente', $parametro->dominio_estimaciones_pendiente, ['class' => 'form-control' . ($errors->has('dominio_expedientes') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_estimaciones_pendiente', '<div class="invalid-tooltip">:message</div>') !!}
            </div>

            <div class="form-group position-relative">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('proceso_expedientes_uso') }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::checkbox('proceso_expedientes_uso', null, $parametro->dominio_expedientes != null, ['class' => 'form-control' . ($errors->has('proceso_expedientes_uso') ? ' is-invalid' : '')]) }}
                        {!! $errors->first('proceso_expedientes_uso', '<div class="invalid-tooltip">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div id="dominio_exp" class="form-group position-relative">
                {{ Form::label('dominio_expedientes') }}
                {{ Form::text('dominio_expedientes', $parametro->dominio_expedientes, ['class' => 'form-control' . ($errors->has('dominio_expedientes') ? ' is-invalid' : '')]) }}
                {!! $errors->first('dominio_expedientes', '<div class="invalid-tooltip">:message</div>') !!}
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-procesos">
                Guardar
            </button>
        </form>
    </div>
</div>
