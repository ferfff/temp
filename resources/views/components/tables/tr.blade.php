@if ($expandable == true)
    <tr data-widget="expandable-table" aria-expanded="false">
        {{ $slot }}
    </tr>
    @if ($detalle)
        <tr class="expandable-body d-none">
            <td colspan="{{ $columns }}">
                <p style="display: none;">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Folio:</strong>
                            {{ $item->folio }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente:</strong>
                            {{ $item->cliente->razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto Adenda:</strong>
                            {{ $item->concepto_adenda }}
                        </div>
                        <div class="form-group">
                            <strong>Licencia:</strong>
                            {{ $item->licencia }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $item->tipo == 1 ? 'Urbanizacion' : 'Edificacion' }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Contrato:</strong>
                            {{ $item->descripcion_contrato }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Fecha Firma:</strong>
                            {{ date('d/m/Y', strtotime($item->fecha_firma)) }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Inicio:</strong>
                            {{ date('d/m/Y', strtotime($item->fecha_inicio)) }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Cierre Siroc:</strong>
                            {{ date('d/m/Y', strtotime($item->fecha_cierre_siroc)) }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Termino:</strong>
                            {{ date('d/m/Y', strtotime($item->fecha_termino)) }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Monto:</strong>
                            $ {{ number_format($item->importe_contratado, 2, '.', ',') }}
                        </div>
                        <div class="form-group">
                            <strong>Suministros:</strong>
                            $ {{ number_format($item->suministros, 2, '.', ',') }}
                        </div>
                        <div class="form-group">
                            <strong>Total Contrato:</strong>
                            $ {{ number_format($item->total_contrato, 2, '.', ',') }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Anticipo:</strong>
                            $ {{ number_format($item->monto_anticipo, 2, '.', ',') }}
                        </div>
                        <div class="form-group">
                            <strong>Porcentaje Amortizacion Anticipo:</strong>
                            {{ $item->porcentaje_amortizacion_anticipo }}%
                        </div>
                        <div class="form-group">
                            <strong>Porcentaje de retencion:</strong>
                            {{ $item->porcentaje_retencion }}%
                        </div>
                        <div class="form-group">
                            <strong>Permite Deductivas:</strong>
                            {{ $item->permite_deductivas == 1 ? 'Si' : 'No' }}
                        </div>
                        <div class="form-group">
                            <strong>Permite Aditivas:</strong>
                            {{ $item->permite_aditivas == 1 ? 'Si' : 'No' }}
                        </div>
                        <div class="form-group">
                            <strong>Activo:</strong>
                            {{ $item->activo == null ? 'Activo' : 'inactivo' }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Calle:</strong>
                            {{ $item->calle }}
                        </div>
                        <div class="form-group">
                            <strong>No Ext:</strong>
                            {{ $item->no_ext }}
                        </div>
                        <div class="form-group">
                            <strong>No Int:</strong>
                            {{ $item->no_int }}
                        </div>
                        <div class="form-group">
                            <strong>Colonia:</strong>
                            {{ $item->colonia }}
                        </div>
                        <div class="form-group">
                            <strong>Localidad:</strong>
                            {{ $item->localidad }}
                        </div>
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $item->referencia }}
                        </div>
                        <div class="form-group">
                            <strong>Municipio:</strong>
                            {{ $item->municipio->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $item->estado->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo Postal:</strong>
                            {{ $item->codigo_postal }}
                        </div>
                    </div>
                </div>
                </p>
            </td>
        </tr>
    @else
        <tr class="expandable-body d-none">
            <td colspan="{{ $columns }}">
                <p style="display: none;">
                    {{ $item->descripcion_contrato }}
                </p>
            </td>
        </tr>
    @endif
@else
    <tr>
        {{ $slot }}
    </tr>
@endif
