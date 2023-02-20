<div class="row col-md-12">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group position-relative">
                    {{ Form::label('base') }}
                    @if ($contrato->model_type == null)
                        <select name="base" id="base" class="form-control">
                            <option value="PostVenta">Post Venta</option>
                            <option value="Presupuesto"
                                {{ str_contains($contrato->model_type, 'Presupuesto') ? 'selected' : '' }}>
                                Presupuesto
                            </option>
                            <option value="Siroc" {{ str_contains($contrato->model_type, 'Siroc') ? 'selected' : '' }}>
                                Siroc</option>
                        </select>
                    @else
                        <input type="text" name="base" id="base" class="form-control"
                            value="{{ str_contains($contrato->model_type, 'Presupuesto') ? 'Presupuesto' : 'Siroc' }}"
                            readonly>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div id="div_folio_base">
                    <div class="form-group position-relative">
                        {{ Form::label('folio_base') }}
                        @if ($contrato->model_id == null)
                            {{ Form::select('folio_base', [], $contrato->model_id, ['class' => 'form-control']) }}
                        @else
                            {{ Form::text('folio_base', $contrato->model->folio, ['class' => 'form-control', 'readonly']) }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="form-group position-relative">
                        <label for="tipo">Tipo de Contrato</label>
                        <br>
                        {{ Form::checkbox('tipo', null, $contrato->tipo, ['class' => 'form-check-input ml-3', 'id' => 'tipo']) }}
                    </div>
                </div>
            </div>
        </div>
        <div id="div_folio">
            <div class="form-group position-relative">
                {{ Form::label('folio') }}
                {{ Form::text('folio', $contrato->folio, ['class' => 'form-control', 'placeholder' => 'Folio']) }}
            </div>
        </div>
        <div class="form-group position-relative">
            {{ Form::label('cliente') }}
            {{ Form::text('cliente_id', $contrato->cliente->razon_social ?? '', ['class' => 'form-control select-cliente', 'placeholder' => 'Clientes', 'id' => 'cliente_id']) }}
        </div>
        <div class="row">
            <div class="form-group position-relative col-md-6">
                {{ Form::label('concepto_adenda') }}
                {{ Form::text('concepto_adenda', $contrato->concepto_adenda, ['class' => 'form-control', 'placeholder' => 'Concepto Adenda']) }}
            </div>
            <div class="form-group position-relative col-md-6">
                {{ Form::label('licencia') }}
                {{ Form::text('licencia', $contrato->licencia, ['class' => 'form-control', 'placeholder' => 'Licencia']) }}
            </div>
        </div>
        <div class="form-group position-relative">
            {{ Form::label('descripcion_contrato') }}
            {{ Form::textarea('descripcion_contrato', $contrato->descripcion_contrato, ['class' => 'form-control', 'placeholder' => 'Descripcion Contrato']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group position-relative">
            {{ Form::label('fecha_firma_y_siroc') }}
            {{ Form::date('fecha_firma', $contrato->fecha_firma ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control', 'id' => 'fecha_firma']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('fecha_inicio') }}
            {{ Form::date('fecha_inicio', $contrato->fecha_inicio ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('fecha_cierre_siroc') }}
            {{ Form::date('fecha_cierre_siroc', $contrato->fecha_cierre_siroc ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('fecha_termino') }}
            {{ Form::date('fecha_termino', $contrato->fecha_termino ?? \Carbon\Carbon::parse('01/01/1900'), ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group position-relative">
            {{ Form::label('importe_contratado') }}
            {{ Form::text('importe_contratado', $contrato->importe_contratado, ['class' => 'form-control', 'placeholder' => 'Importe Contratado', 'style' => 'text-align:right']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('suministros') }}
            {{ Form::text('suministros', $contrato->suministros, ['class' => 'form-control', 'placeholder' => 'Suministros', 'style' => 'text-align:right']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('total_contrato') }}
            {{ Form::text('total_contrato', $contrato->total_contrato, ['class' => 'form-control', 'placeholder' => 'Total del contrato', 'style' => 'text-align:right', 'readonly']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('monto_anticipo') }}
            {{ Form::text('monto_anticipo', $contrato->monto_anticipo, ['class' => 'form-control', 'placeholder' => 'Monto Anticipo', 'style' => 'text-align:right']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('porcentaje_amortizacion_anticipo') }}
            {{ Form::text('porcentaje_amortizacion_anticipo', $contrato->porcentaje_amortizacion_anticipo, ['class' => 'form-control', 'placeholder' => 'Porcentaje Amortizacion Anticipo', 'style' => 'text-align:right']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('porcentaje_retencion') }}
            {{ Form::text('porcentaje_retencion', $contrato->porcentaje_retencion, ['class' => 'form-control', 'placeholder' => 'Porcentaje Retencion', 'style' => 'text-align:right']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('permite_deductivas') }}
            <br>
            {{ Form::checkbox('permite_deductivas', null, $contrato->permite_deductivas, ['class' => 'form-check-input ml-3', 'placeholder' => 'Permite Deductivas']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('permite_aditivas') }}
            <br>
            {{ Form::checkbox('permite_aditivas', null, $contrato->permite_aditivas, ['class' => 'form-check-input ml-3', 'placeholder' => 'Permite Deductivas']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group position-relative">
            {{ Form::label('estado') }}
            {{ Form::select('estado_id', $estados, $contrato->estado_id == null ? 11 : $contrato->estado_id, ['class' => 'form-control select_estado', 'id' => 'estado_id']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('municipio') }}
            {{ Form::select('municipio_id', $municipios, $contrato->municipio_id, ['class' => 'form-control select_municipio', 'placeholder' => 'Municipio', 'id' => 'municipio_id']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('localidad') }}
            {{ Form::text('localidad', $contrato->localidad, ['class' => 'form-control', 'placeholder' => 'Localidad']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('codigo_postal') }}
            {{ Form::text('codigo_postal', $contrato->codigo_postal, ['class' => 'form-control select_cp', 'placeholder' => 'Codigo postal']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('colonia') }}
            {{ Form::text('colonia', $contrato->colonia, ['class' => 'form-control select_colonia', 'placeholder' => 'Colonia']) }}
        </div>
        <div class="form-group position-relative">
            {{ Form::label('calle') }}
            {{ Form::text('calle', $contrato->calle, ['class' => 'form-control', 'placeholder' => 'Calle']) }}
        </div>
        <div class="row">
            <div class="form-group position-relative col-md-6">
                {{ Form::label('no_ext') }}
                {{ Form::text('no_ext', $contrato->no_ext, ['class' => 'form-control', 'placeholder' => 'No Ext', 'style' => 'text-align:right']) }}
            </div>
            <div class="form-group position-relative col-md-6">
                {{ Form::label('no_int') }}
                {{ Form::text('no_int', $contrato->no_int, ['class' => 'form-control', 'placeholder' => 'No Int', 'style' => 'text-align:right']) }}
            </div>
        </div>
        <div class="form-group position-relative">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $contrato->referencia, ['class' => 'form-control', 'placeholder' => 'Referencia']) }}
        </div>
    </div>
</div>
