<?php

namespace App\Exports;

use App\Models\Contrato;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ContratoExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    use Exportable;

    public function forId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Contrato::query()->whereId($this->id);
    }

    public function map($contrato): array
    {
        return [
            $contrato->id,
            $contrato->folio,
            $contrato->cliente->razon_social,
            $contrato->fecha_firma,
            $contrato->fecha_inicio,
            $contrato->fecha_cierre_siroc,
            $contrato->fecha_termino,
            $contrato->monto_anticipo,
            $contrato->importe_contratado,
            $contrato->suministros,
            $contrato->total_contrato,
            $contrato->porcentaje_amortizacion_anticipo / 100,
            $contrato->concepto_adenda,
            $contrato->descripcion_contrato,
            $contrato->licencia,
            $contrato->calle,
            $contrato->no_ext,
            $contrato->no_int,
            $contrato->colonia,
            $contrato->localidad,
            $contrato->referencia,
            $contrato->municipio->nombre,
            $contrato->estado->nombre,
            $contrato->codigo_postal,
            $contrato->permite_deductivas == 1 ? 'Permite deductivas' : 'No permite deductivas',
            $contrato->porcentaje_retencion / 100,
            Date::dateTimeToExcel($contrato->created_at),
            Date::dateTimeToExcel($contrato->updated_at),
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'folio',
            'cliente', //cliente_id
            'fecha_firma',
            'fecha_inicio',
            'fecha_cierre_siroc',
            'fecha_termino',
            'monto_anticipo',
            'importe_contratado',
            'suministros',
            'total_contrato',
            'porcentaje_amortizacion_anticipo',
            'concepto_adenda',
            'descripcion_contrato',
            'licencia',
            'calle',
            'no_ext',
            'no_int',
            'colonia',
            'localidad',
            'referencia',
            'municipio', //municipio_id
            'estado', //estado_id
            'codigo_postal',
            'permite_deductivas',
            'porcentaje_retencion',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'I' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'J' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'K' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'L' => NumberFormat::FORMAT_PERCENTAGE,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'X' => NumberFormat::FORMAT_NUMBER,
            'Z' => NumberFormat::FORMAT_PERCENTAGE,
            'AA' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
