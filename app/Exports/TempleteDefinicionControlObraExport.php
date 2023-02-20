<?php

namespace App\Exports;

use App\Models\Contrato;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TempleteDefinicionControlObraExport implements FromView, WithColumnWidths, WithStyles, WithEvents
{
    use Exportable;

    public function forContrato(Contrato $contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }

    public function view(): View
    {
        return view('exports.definicion', [
            'contrato' => $this->contrato,
        ]);
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
