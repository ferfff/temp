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
<table>
    <thead>
        <tr>
            <th>103</th>
            <th>Preliminares</th>
        </tr>
        <tr>
            <th scope="col" style="background: #39c0e9">Clave</th>
            <th scope="col" style="background: #39c0e9">Concepto</th>
            <th scope="col" style="background: #39c0e9">Unidad</th>
            <th scope="col" style="background: #39c0e9">Cantidad</th>
            <th scope="col" style="background: #39c0e9">P.U</th>
            <th scope="col" style="background: #39c0e9">Importe</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>103</td>
            <td>Preliminares</td>
        </tr>
        <tr>
            <td>51-01</td>
            <td>
                TRAZO Y NIVELACION DE TERRENO NATURAL A REVENTON DE HILO ESTABLECIENDO EJES Y REFERENCIAS NECESARIAS.
                INCLUYE: MATERIALES, MANO DE OBRA, HERRAMIENTA Y EQUIPO. P.U.O.T.
            </td>
            <td>M2</td>
            <td>191.86</td>
            <td>$8.41</td>
            <td>$1,613.54</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>104</th>
            <th>Cimientacion</th>
        </tr>
        <tr>
            <th scope="col" style="background: #39c0e9">Clave</th>
            <th scope="col" style="background: #39c0e9">Concepto</th>
            <th scope="col" style="background: #39c0e9">Unidad</th>
            <th scope="col" style="background: #39c0e9">Cantidad</th>
            <th scope="col" style="background: #39c0e9">P.U</th>
            <th scope="col" style="background: #39c0e9">Importe</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>51-06</td>
            <td>
                HABILITADO Y ARMADO DE LOSA DE CIMENTACION CON ACERO DEL NO. 3 ( 3/8" ), DEL NO. 4 ( 1/2" ), MALLA
                6X6-10/10 CON TRABES DE LIGA TL-1 Y TL-2 , ZAPATAS ZA-1,ZA-2,ZA-3,ZA-4,ZA-5 Y ZC-2, Y COLUMNAS C-1 Y C-2
                EL PRECIO INCLUYE: GANCHOS, DOBLECES, TRASLAPES, ACARREOS, DESPERDICIOS, MATERIALES, MANO DE OBRA,
                HERRAMIENTA Y TODO LO NECESARIO PARA SU CORRECTA EJECUCION. P.U.O.T.
            </td>
            <td>M2</td>
            <td>160.87</td>
            <td>$408.70</td>
            <td>$65,747.57</td>
        </tr>
    </tbody>
</table>
