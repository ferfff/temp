<form action="{{ route('estimaciones.store') }}" method="post" id="formulario-crear" autocomplete="off">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Agregar Estimación a contrato: {{ $contrato->folio }}/
            <small> {{ $contrato->cliente->razon_social }}</small>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" name="contrato_id" id="contrato_id" value="{{ $contrato->uid }}">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_estimacion">Numero de Estimación</label>
                                <input type="text" name="numero_estimacion" id="numero_estimacion"
                                    class="form-control" style='text-align:right'
                                    value="{{ $estimaciones->count() > 0 ? $estimaciones->first()->max + 1 : 1 }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group position-relative">
                                <label for="fecha_estimacion">Fecha de Estimación</label>
                                <input type="date" name="fecha_estimacion" id="fecha_estimacion"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row position-relative">
                                <label for="total_contrato" class="col-md-6 col-form-label">Total Contrato</label>
                                <input type="text" name="total_contrato" id="total_contrato"
                                    class="form-control col-md-6" style='text-align:right'
                                    value="${{ number_format($contrato->total_contrato, 2, '.', ',') }}" disabled>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="amortizacion" class="col-md-6 col-form-label">
                                    Amortizacion (<small id="total_anticipo">
                                        ${{ number_format($contrato->monto_anticipo, 2, '.', ',') }}
                                    </small>)
                                </label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="amortizacion" id="amortizacion_porcentaje"
                                                class="form-control" style='text-align:right'
                                                value="{{ $amortizacion < $contrato->monto_anticipo ? $contrato->porcentaje_amortizacion_anticipo : '0' }}%"
                                                {{ $amortizacion < $contrato->monto_anticipo ? '' : 'disabled' }}>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="amortizacion" id="amortizacion_monto"
                                                class="form-control" style='text-align:right'
                                                value="${{ $amortizacion < $contrato->monto_anticipo ? number_format($contrato->monto_anticipo * ($contrato->porcentaje_amortizacion_anticipo / 100), 2, '.', ',') : '0' }}"
                                                {{ $amortizacion < $contrato->monto_anticipo ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="monto_ejecutar" class="col-md-6 col-form-label">Monto por Ejecutar</label>
                                <input type="text" name="monto_ejecutar" id="monto_ejecutar"
                                    class="form-control col-md-6" style='text-align:right' readonly>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="total" class="col-md-6 col-form-label">Total del trabajo hasta la
                                    fecha</label>
                                <input type="text" class="form-control col-md-6" style='text-align:right'
                                    id="total" disabled>
                            </div>
                            <div class="form-group row position-relative">
                                <label class="col-md-6 col-form-label">Acumulado hasta estimación anterior</label>
                                <input type="text" class="form-control col-md-6" name="acumulado" id="acumulado"
                                    style='text-align:right'
                                    value="${{ number_format($contrato->total_estimado, 2, '.', ',') }}" readonly>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="monto_facturar" class="col-md-6 col-form-label">Monto por Facturar</label>
                                <input type="text" name="monto_facturar" id="monto_facturar"
                                    class="form-control col-md-6" style='text-align:right'>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="retencion_acumulado" class="col-md-6 col-form-label"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    Acumulado de retencion
                                </label>
                                <input id="retencion_acumulado" class="form-control col-md-6"
                                    style='text-align:right' value="${{ number_format($retenido, 2, '.', ',') }}"
                                    disabled>
                                <input type="hidden" id="h_retencion_acumulado" value="{{ $retenido }}">
                            </div>
                            <div class="form-group row position-relative">
                                <label for="porcentaje" class="col-md-6 col-form-label"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    Retencion
                                </label>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="porcentaje" value="{{ $contrato->porcentaje_retencion }}%"
                                                class="form-control" style='text-align:right'>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="retencion" id="retencion"
                                                class="form-control" style='text-align:right'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row position-relative">
                                <label for="total_facturar" class="col-md-6 col-form-label">Total por Facturar</label>
                                <input type="text" name="total_facturar" id="total_facturar"
                                    class="form-control col-md-6" style='text-align:right' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <textarea name="comentario" class="form-control" id="comentario"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm mt-2" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-sm mt-2" id="enviar-crear">
            Guardar
        </button>
    </div>
</form>
