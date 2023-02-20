<?php

namespace App\Imports;

use App\Models\Contrato;
use App\Models\ControlObra;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ControlObraImport implements ToCollection, WithBatchInserts, WithChunkReading, WithCalculatedFormulas
{
    use Importable;

    private $control;
    private $contrato;

    public function __construct()
    {
        $this->contrato = Contrato::pluck('id', 'folio');
    }

    public function collection(Collection $rows)
    {
        /*
        $row[0] - clave
        $row[1] - partida
        $row[2] - unidad
        $row[3] - cantidad
        $row[4] - precio unitario
        $row[5] - importe
         */

        $codigo = null;
        $grupo = null;
        $contrato = $this->contrato[trim($rows[8][2])];

        foreach ($rows as $row) {
            $codigo = !empty($row[0]) && !empty($row[1]) && empty($row[2]) && empty($row[3]) && empty($row[4]) && empty($row[5]) ? $row[0] : $codigo;
            $grupo = !empty($row[0]) && !empty($row[1]) && empty($row[2]) && empty($row[3]) && empty($row[4]) && empty($row[5]) ? $row[1] : $grupo;

            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5])) {
                if (Str::slug($row[0]) != 'clave' && Str::slug($row[1]) != 'partida' && Str::slug($row[2]) != 'unidad' && $row[3] != 'cantidad' && (Str::slug($row[4]) != 'precio_unitario' || Str::slug($row[4] != 'pu')) && $row[5] != 'importe') {

                    $clave = ControlObra::where('clave', mb_strtoupper($row[0]))->first();

                    ControlObra::create([
                        'uuid' => $clave != null && $clave->contrato_id == $contrato && $codigo == $clave->codigo_grupo ? $clave->uuid : Str::uuid(),
                        'hash' => md5(mb_strtoupper($row[0]) . '-' . mb_strtoupper($row[1]) . '-' . $row[2] . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $row[3])) . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $row[4])) . '-' . $codigo . '-' . ucfirst(mb_strtolower($grupo)) . '-' . floatval(preg_replace("/[^-0-9\.]/", "", $row[5]) . '-' . $contrato)),
                        'codigo_grupo' => $codigo,
                        'grupo' => ucfirst(mb_strtolower($grupo)),
                        'clave' => mb_strtoupper($row[0]),
                        'partida' => mb_strtoupper($row[1]),
                        'unidad' => $row[2],
                        'cantidad' => floatval(preg_replace("/[^-0-9\.]/", "", $row[3])),
                        'precio_unitario' => floatval(preg_replace("/[^-0-9\.]/", "", $row[4])),
                        'importe' => floatval(preg_replace("/[^-0-9\.]/", "", $row[5])),
                        'contrato_id' => $contrato,
                    ]);
                }
            }
        }
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
