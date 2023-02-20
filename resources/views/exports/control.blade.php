@php
    $subtotal = 0;
    $total = 0;
    $total_importe = 0;
@endphp
<table>
    <thead>
        <tr>
            <th></th>
            <th>Estimacion </th>
            <td>1</td>
        </tr>
        <tr>
            <th></th>
            <th>Fecha</th>
            <td>{{ date('d/m/Y') }}</td>
        </tr>
        <tr>
            <th></th>
            <th>Periodo</th>
            <td>{{ $contrato->fecha_inicio . ' - ' . $contrato->fecha_termino }}</td>
        </tr>
        <tr>
            <th></th>
            <th>Fraccionamiento</th>
            <td></td>
        </tr>
        <tr>
            <th></th>
            <th>Ciudad</th>
            <td>{{ $contrato->municipio->nombre . ' ' . $contrato->estado->nombre }}</td>
        </tr>
        <tr>
            <th></th>
            <th>Empresa</th>
            <td>INGENIERIA Y CONSTRUCCION GUTIERREZ S.A DE C.V.</td>
        </tr>
        <tr>
            <th></th>
            <th>Trabajos</th>
            <td>{{ $contrato->descripcion_contrato }}</td>
        </tr>
        <tr>
            <th></th>
            <th>Tipo</th>
            <td>Urbanizacion</td>
        </tr>
        <tr>
            <th></th>
            <th>Contrato</th>
            <td>{{ $contrato->folio }}</td>
        </tr>
    </thead>
</table>
@for ($i = 0; $i < count($keys); $i++)
    <table>
        <thead>
            <th>{{ $codigos[$i] }}</th>
            <th>{{ $keys[$i] }}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            @for ($j = $max_estimaciones; $j >= 1; $j--)
                <th colspan="2" style="background: #39c0e9" class="text-white">
                    <center>Estimacion {{ $j }}</center>
                </th>
            @endfor
            <th colspan="2" style="background: #39c0e9" class="text-white">
                <center>Acumulado</center>
            </th>
            <th rowspan="2" style="background: #39c0e9" class="text-white">
                <center>Avance</center>
            </th>
        </thead>
    </table>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col" style="background: #39c0e9">Clave</th>
                <th scope="col" style="background: #39c0e9">
                    Concepto</th>
                <th scope="col" style="background: #39c0e9">
                    Unidad</th>
                <th scope="col" style="background: #39c0e9">
                    Cantidad</th>
                <th scope="col" style="background: #39c0e9">
                    P.U
                </th>
                <th scope="col" style="background: #39c0e9">
                    Importe
                </th>
                @for ($j = $max_estimaciones; $j >= 1; $j--)
                    <th scope="col" style="background: #9fe706" class="text-white">
                        Cantidad</th>
                    <th scope="col" style="background: #e8e824" class="text-white">
                        Importe</th>
                @endfor
                <th scope="col" class="text-white" style="background: #9fe706">Cantidad</th>
                <th scope="col" class="text-white" style="background: #e8e824">Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contrato->control->where('grupo', $keys[$i]) as $control)
                @php
                    $cantidad_acumulada = 0;
                    $importe_acumulada = 0;
                    $faltante = 0;
                    foreach ($control->definiciones as $definicion) {
                        $cantidad_acumulada += floatval($definicion->cantidad);
                        $importe_acumulada += floatval($definicion->importe);
                        $faltante = $max_estimaciones - $definicion->destajos_count;
                    }
                    $total_importe += $control->importe;
                    $subtotal += $importe_acumulada;
                @endphp
                <tr>
                    <td scope="row">
                        {{ $control->clave }}
                    </td>
                    <td>{{ $control->partida }}</td>
                    <td>{{ $control->unidad }}</td>
                    <td style="text-align: right">
                        {{ number_format($control->cantidad, 2, '.', ',') }}
                    </td>
                    <td style="text-align: right">
                        {{ "$" . number_format($control->precio_unitario, 2, '.', ',') }}
                    </td>
                    <td style="text-align: right">
                        {{ "$" . number_format($control->importe, 2, '.', ',') }}
                    </td>
                    @foreach ($control->definiciones as $definicion)
                        <td>{{ $definicion->cantidad }}</td>
                        <td>{{ $definicion->importe }}</td>
                    @endforeach
                    @for ($j = 0; $j < $faltante; $j++)
                        <td style="text-align: right"></td>
                        <td style="text-align: right"></td>
                    @endfor
                    <td style="text-align: right">
                        {{ number_format($cantidad_acumulada, 2, '.', ',') }}
                    </td>
                    <td style="text-align: right">
                        {{ "$" . number_format($importe_acumulada, 2, '.', ',') }}
                    </td>
                    <td style="text-align: right">
                        @php
                            $avance = $importe_acumulada / $control->importe;
                        @endphp
                        {{ number_format($avance * 100, 2, '.', ',') . '%' }}
                    </td>
                </tr>
                @if ($loop->last)
                    <tr>
                        <td colspan="9" style="text-align: right">
                        </td>
                        <td>{{ "$" . number_format($subtotal, 2, '.', ',') }}
                        </td>
                    </tr>
                    @php
                        $total += $subtotal;
                        $subtotal = 0;
                    @endphp
                @endif
            @endforeach
        </tbody>
    </table>
@endfor
<table class="table table-sm table-hover">
    <tbody>
        <tr class="table-primary">
            @php
                $iva_total = $total * $iva;
                $iva_importe = $total_importe * $iva;
            @endphp
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="w-75" style="text-align: right">
                <b>Subtotal:</b>
            </td>
            <td>{{ "$" . number_format($total_importe, 2, '.', ',') }}</td>
            @for ($j = 0; $j < $max_estimaciones; $j++)
                <td style="text-align: right"></td>
                <td style="text-align: right"></td>
            @endfor
            <td style="text-align: right"></td>
            <td>
                {{ "$" . number_format($total, 2, '.', ',') }}
            </td>
        </tr>
        <tr class="table-warning">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="w-75" style="text-align: right">
                <b>Iva:</b>
            </td>
            <td>{{ "$" . number_format($iva_importe, 2, '.', ',') }}</td>
            @for ($j = 0; $j < $max_estimaciones; $j++)
                <td style="text-align: right"></td>
                <td style="text-align: right"></td>
            @endfor
            <td style="text-align: right"></td>
            <td>
                {{ "$" . number_format($iva_total, 2, '.', ',') }}
            </td>
        </tr>
        <tr class="table-success">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="w-75" style="text-align: right">
                <b>Total:</b>
            </td>
            <td>
                {{ "$" . number_format($total_importe + $iva_importe, 2, '.', ',') }}
            </td>
            @for ($j = 0; $j < $max_estimaciones; $j++)
                <td style="text-align: right"></td>
                <td style="text-align: right"></td>
            @endfor
            <td style="text-align: right"></td>
            <td>
                {{ "$" . number_format($total + $iva_total, 2, '.', ',') }}
            </td>
        </tr>
    </tbody>
</table>
