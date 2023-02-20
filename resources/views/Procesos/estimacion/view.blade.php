<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">
        Modificar Estimación: {{ $contrato->folio }}/
        <small> {{ $contrato->cliente->razon_social }}</small>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="numero_estimacion2">Numero de Estimación</label>
                    <input type="text" name="numero_estimacion" id="numero_estimacion2" class="form-control"
                        style='text-align:right' readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="fecha_estimacion">Fecha de Estimación</label>
                    <input type="date" name="fecha_estimacion" id="fecha_estimacion2" class="form-control" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row position-relative">
            <label for="total_contrato" class="col-sm-6 col-form-label">Total Contrato</label>
            <input type="text" name="total_contrato" id="total_contrato" class="form-control col-sm-6"
                style='text-align:right' value="${{ number_format($contrato->total_contrato, 2, '.', ',') }}" disabled>
        </div>
        <div class="form-group row position-relative">
            <label for="amortizacion" class="col-sm-6 col-form-label">Amortizacion</label>
            <div class="form-group row position-relative">
                <label for="amortizacion" class="col-sm-6 col-form-label">Amortizacion</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="amortizacion" id="amortizacion2" class="form-control"
                                style='text-align:right' readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="amortizacion" id="amortizacion_porcentaje2" class="form-control"
                                style='text-align:right' readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row position-relative">
            <label for="acumulado2" class="col-sm-6 col-form-label">Total del trabajo Hasta la
                fecha</label>
            <input type="text" class="form-control col-sm-6" style='text-align:right' id="acumulado2" disabled>
        </div>
        <div class="form-group row position-relative">
            <label for="monto_ejecutar" class="col-sm-6 col-form-label">Monto por Ejecutar</label>
            <input type="text" name="monto_ejecutar" id="monto_ejecutar2" class="form-control col-sm-6"
                style='text-align:right' readonly>
        </div>
        <div class="form-group row position-relative">
            <label class="col-sm-6 col-form-label">Acumulado hasta estimacion anterior</label>
            <input type="text" name="acumulado" id="acumulado2" class="form-control col-sm-6"
                style='text-align:right' readonly>
        </div>
        <div class="form-group row position-relative">
            <label class="col-sm-6 col-form-label" for="monto_facturar">Monto por Facturar</label>
            <input type="text" name="monto_facturar" id="monto_facturar2" class="form-control col-sm-6"
                style='text-align:right' readonly>
        </div>
        <div class="form-group row position-relative">
            <label for="retencion_acumulado2" class="col-sm-6 col-form-label"
                style="display: flex; justify-content: space-between; align-items: center;" readonly>
                Acumulado de retencion
            </label>
            <input id="retencion_acumulado2" class="form-control col-sm-6" style='text-align:right' disabled>
        </div>
        <div class="form-group row position-relative">
            <label for="retencion" class="col-sm-6 col-form-label"
                style="display: flex; justify-content: space-between; align-items: center;">
                Porcentaje de retencion
            </label>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <input id="porcentaje2" class="form-control" style='text-align:right' readonly>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="retencion" id="retencion2" class="form-control"
                            style='text-align:right' readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row position-relative">
            <label for="total_facturar" class="col-sm-6 col-form-label">Total por Facturar</label>
            <input type="text" name="total_facturar" id="total_facturar2" class="form-control col-sm-6"
                style='text-align:right' readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea name="comentario" class="form-control" id="comentario2" readonly></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm mt-2" data-dismiss="modal">Cerrar</button>
</div>
