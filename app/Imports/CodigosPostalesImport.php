<?php

namespace App\Imports;

use App\Models\CodigoPostal;
use App\Models\Municipio;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CodigosPostalesImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithValidation, SkipsOnError, SkipsOnFailure
{

    use Importable, SkipsErrors, SkipsFailures;

    private $municipios;

    public function __construct()
    {
        $this->municipios = Municipio::pluck('id', 'nombre');
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CodigoPostal([
            'CP' => $row['d_codigo'],
            'slug' => Str::slug($row['d_codigo']),
            'municipio_id' => $this->municipios[mb_strtoupper($row['d_mnpio'], 'UTF-8')],
        ]);
    }

    public function chunkSize(): Int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            'd_codigo' => ['required', 'numeric'],
            'd_mnpio' => ['required', 'exists:municipios,nombre'],
        ];
    }
}
