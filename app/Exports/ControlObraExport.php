<?php

namespace App\Exports;

use App\Models\Contrato;
use App\Models\ControlObra;
use App\Models\DestajoObra;
use App\Models\Parametro;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ControlObraExport implements FromView, WithColumnFormatting, WithColumnWidths, WithStyles, WithEvents
{
    use Exportable;

    public function forId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function forRango($rango)
    {
        $this->rango = $rango;
        return $this;
    }

    public function forMin($min)
    {
        $this->min = $min;
        return $this;
    }

    public function forMax($max)
    {
        $this->max = $max;
        return $this;
    }

    public function view(): View
    {
        $definiciones = ControlObra::whereRelation('contrato', 'uid', $this->id)->pluck('id');
        $estimacion = DestajoObra::select(DB::raw('MAX(estimacion) as estimacion'))->whereIn('control_id', $definiciones)->first()->estimacion;

        $contrato = Contrato::with([
            'control' => fn($query) => $query
                ->with([
                    'definiciones' => fn($query) => $query->select('control_obras.id', 'control_obras.uuid', 'destajo.control_id',
                        'destajo.cantidad', 'destajo.importe', 'destajo.estimacion', 'destajo.created_at')
                        ->join('destajo_obras as destajo', 'control_obras.id', '=', 'destajo.control_id')
                        ->withCount('destajos')
                        ->orderBy('destajo.created_at', 'DESC')
                        ->when($this->rango == 1, fn($query) => $query->where('destajo.estimacion', $estimacion))
                        ->when($this->rango == 2, fn($query) => $query->whereBetween('destajo.estimacion', [$this->min, $this->max])),
                ])
                ->orderBy('codigo_grupo')
                ->orderBy('grupo')
                ->orderBy('clave')
                ->whereIn('control_obras.id', function ($query) {
                    return $query->select(DB::raw('MAX(control_obras.id)'))->from('control_obras')->whereNull('deleted_at')->groupBy('clave');
                }),
        ])
            ->where('uid', $this->id)
            ->first();
        $keys = [];
        $codigo = [];
        $estimaciones = [];
        foreach ($contrato->control as $grupo) {
            if (!in_array($grupo->grupo, $keys)) {
                $keys[] = $grupo->grupo;
                $codigo[] = $grupo->codigo_grupo;
            }
            $estimaciones[] = !$grupo->definiciones->isEmpty() ? $grupo->definiciones->first()->destajos_count : 1;
        }
        return view('exports.control', [
            'contrato' => $contrato,
            'keys' => $keys,
            'codigos' => $codigo,
            'max_estimaciones' => max($estimaciones),
            'iva' => Parametro::select('iva')->first()->iva / 100,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'F' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'J' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'L' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 75,
            'C' => 10,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A11:F9999')->getAlignment()->setWrapText(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A11:f9999')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A11:f9999')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            },
        ];
    }
}
