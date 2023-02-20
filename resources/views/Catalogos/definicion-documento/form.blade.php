<div class="box box-info padding-1">
    <div class="box-body row col-md-12">
        <div class="form-group position-relative col-md-4">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $definicionDocumento->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
        </div>
        <div class="form-group position-relative col-md-4">
            {{ Form::label('apertura_cierre') }}
            {{ Form::select('ciclo_id', $ciclo, $definicionDocumento->ciclo_id, ['class' => 'form-control', 'placeholder' => 'Seleccione Uno', 'id' => 'ciclo_id']) }}
        </div>
        <div class="form-group position-relative col-md-4">
            {{ Form::label('activo', null, ['class' => 'font-weight-bold']) }}
            {{ Form::checkbox('activo', null, $definicionDocumento->deleted_at == null, ['class' => 'form-check-input', 'id' => 'activo']) }}
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('¿Obligatorio?:', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('obligatorio', null, $definicionDocumento->obligatorio, ['class' => 'form-check-input', 'id' => 'obligatorio']) }}
                    <a href="javascript:" data-toggle="popover" title="Uso Obligatorio" data-trigger="focus"
                        data-content="Solo aquellos marcados como obligatorios serán requeridos para considerar el expediente como completo.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('¿Solicita Aprobacion?', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('solicita_aprobacion', null, $definicionDocumento->solicita_aprobacion, ['class' => 'form-check-input', 'id' => 'aprobacion']) }}
                    <a href="javascript:" data-toggle="popover" title="Solicita Aprobacion" data-trigger="focus"
                        data-content="<ul><li>Si, deberá ser aprobado: un usuario facultado, deberá revisar y aprobar o rechazar el documento. </li>
                                            <li>No, se aprueba al subirlo: el documento queda aprobado automáticamente al subirlo al sistema</li></ul>">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('¿Comentario?', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('solicita_comentario', null, $definicionDocumento->solicita_comentario, ['class' => 'form-check-input', 'id' => 'comentario']) }}
                    <a href="javascript:" data-toggle="popover" title="Solicita Comentario" data-trigger="focus"
                        data-content="Al momento de proporcionar el documento, se deberá agregar una observación que acompañe el o los archivos proporcionados.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('¿Multiple?', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('multiple', null, $definicionDocumento->multiple, ['class' => 'form-check-input', 'id' => 'multiple']) }}
                    <a href="javascript:" data-toggle="popover" title="Multiple" data-trigger="focus"
                        data-content="<ul><li>Si acepta: el documento podrá repetirse las veces que sea necesario.</li>
                                <li>No acepta: solo se podrá registrar una vez el documento y no podrá repetirse</li></ul>">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('¿Referencia?', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('referencia', null, $definicionDocumento->referencia, ['class' => 'form-check-input', 'id' => 'referencia']) }}
                    <a href="javascript:" data-toggle="popover" title="Referencia" data-trigger="focus"
                        data-content="Solicita un dato de referencia.">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('seguimiento', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('seguimiento', null, $definicionDocumento->seguimiento, ['class' => 'form-check-input', 'id' => 'seguimiento']) }}
                    <a href="javascript:" data-toggle="popover" title="Seguimiento" data-trigger="focus"
                        data-content="Solicita una Fecha Limite para marcar como “Pendiente Resuelto">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group position-relative col-md-6">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::label('aplazamiento', null, ['class' => 'font-weight-bold']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::checkbox('aplazamiento', null, $definicionDocumento->aplazamiento, ['class' => 'form-check-input', 'id' => 'aplazamiento']) }}
                    <a href="javascript:" data-toggle="popover" title="Aplazamiento" data-trigger="focus"
                        data-content="Permite modificar la fecha de término de un contrato">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-sm btn-primary" id="enviar-documento">
            Guardar
        </button>
        <a href="{{ route('definicion-documentos.index') }}" class="btn btn-sm btn-default">Cancelar</a>
    </div>
</div>
