<?php

namespace App\Imports;

use App\Models\Jornal;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class JornalImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Jornal([
            'NSS' => $row['nss'],
            'slug' => Str::slug($row['nombre_completo']),
            'nombre_completo' => $row['nombre_completo'],
            'departamento' => $row['departamento'],
            'curp' => $row['curp'],
            'dias_laborados' => $row['dias_laborados'],
            'SDI' => $row['sdi'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nss' => 'required',
            'nombre_completo' => 'required',
            'departamento' => 'required',
            'curp' => 'required',
            'dias_laborados' => 'required',
            'sdi' => 'required',
        ];
    }

    public function batchSize(): Int
    {
        return 1000;
    }

    public function chunkSize(): Int
    {
        return 100;
    }
}
