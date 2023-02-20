<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Datos del Cliente</span>
    </div>
    <div class="card-body">
        <div class="box box-info padding-1">
            <div class="box-body">
                <div class="row col-md-12">
                    <div class="form-group position-relative col-md-4">
                        {{ Form::label('razon_social') }}
                        {{ Form::text('razon_social', $cliente->razon_social, ['class' => 'form-control', 'placeholder' => 'Razon Social']) }}
                    </div>
                    <div class="form-group position-relative col-md-4">
                        {{ Form::label('registro_patronal_del_cliente') }}
                        {{ Form::text('registro_patronal', $cliente->registro_patronal, ['class' => 'form-control', 'placeholder' => 'Registro Patronal', 'id' => 'registro_patronal']) }}
                    </div>
                    <div class="form-group position-relative col-md-4">
                        {{ Form::label('RFC') }}
                        {{ Form::text('RFC', $cliente->RFC, ['class' => 'form-control text-uppercase', 'placeholder' => 'Rfc']) }}
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group position-relative col-md-4">
                        {{ Form::label('repse') }}
                        {{ Form::text('repse', $cliente->repse, ['class' => 'form-control', 'placeholder' => 'Repse']) }}
                    </div>
                    <div class="form-group position-relative col-md-4">
                        {{ Form::label('contacto') }}
                        {{ Form::text('contacto', $cliente->contacto, ['class' => 'form-control', 'placeholder' => 'Contacto']) }}
                    </div>
                    <div class="row col-md-4">
                        <div class="form-group position-relative col-md-3">
                            {{ Form::label('activo') }}
                            <br>
                            {{ Form::checkbox('activo', null, $cliente->deleted_at == null, ['class' => 'form-check-input', 'data-size' => 'mini']) }}
                        </div>
                        <div class="form-group position-relative col-md-3">
                            {{ Form::label('presupuesto') }}
                            <a href="javascript:" data-toggle="popover" title="Ayuda" data-trigger="focus"
                                data-content="<ul><li>Si: el cliente estará disponible para el registro de un presupuesto</li>
                                                <li>No: el cliente no estará disponible para la captura de presupuestos</li></ul>">
                                <i class="fa fa-info-circle"></i>
                            </a>
                            <br>
                            {{ Form::checkbox('presupuesto', null, $cliente->presupuesto == 1, ['class' => 'form-check-input', 'data-size' => 'mini']) }}
                        </div>
                        <div class="form-group position-relative col-md-3">
                            {{ Form::label('siroc') }}
                            <a href="javascript:" data-toggle="popover" title="Ayuda" data-trigger="focus"
                                data-content="<ul><li>Si: el cliente estará disponible para el registro de un siroc</li>
                                                <li>No: el cliente no estará disponible para la captura de siroc</li></ul>">
                                <i class="fa fa-info-circle"></i>
                            </a>
                            <br>
                            {{ Form::checkbox('siroc', null, $cliente->siroc == 1, ['class' => 'form-check-input', 'data-size' => 'mini']) }}
                        </div>
                        <div class="form-group position-relative col-md-3">
                            {{ Form::label('expediente') }}
                            <a href="javascript:" data-toggle="popover" title="Ayuda" data-trigger="focus"
                                data-content="<ul><li>Solicita expediente Completo: los contratos de este cliente, deberán estar completos para iniciar el proceso de estimaciones.</li>
                                                    <li>No solicita: los contratos de este cliente, no requerirán expediente completo para iniciar el proceso de estimaciones
                                                    (nota: un expediente incompleto puede repercutir en el correcto seguimiento de un contrato)
                                    </li></ul>">
                                <i class="fa fa-info-circle"></i>
                            </a>
                            <br>
                            {{ Form::checkbox('expediente', null, $cliente->expediente == 1, ['class' => 'form-check-input', 'data-size' => 'mini']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target="#exampleModal">
    Agregar Correo
</button>

<x-tables.table :headers="['', 'Titulo', 'Nombre', 'Correo', 'Tipo de correo', 'Proceso']">
    @foreach ($cliente->correos as $correo)
        <tr class="trow">
            <x-tables.td class="controls">
                <a href="#" class="list_cancel" title="Eliminar">
                    <i class="fas fa-times"></i>
                </a>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-titulo">{{ $correo->titulo }}</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-nombre">{{ $correo->nombre }}</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-correo">{{ $correo->correo }}</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-tipo">{{ $correo->tipo_correo }}</label>
            </x-tables.td>
            <x-tables.td>
                <label id="lbl-proceso">{{ $correo->tipo_proceso }}</label>
            </x-tables.td>
        </tr>
    @endforeach
</x-tables.table>
<div class="box-footer mt20">
    <button type="button" class="btn btn-sm btn-primary" id="enviar-cliente">
        Guardar
    </button>
    <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-default">Cancelar</a>
</div>
