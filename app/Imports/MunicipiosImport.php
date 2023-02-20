<?php

namespace App\Imports;

use App\Models\Estado;
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

class MunicipiosImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithValidation, SkipsOnError, SkipsOnFailure
{

    use Importable, SkipsErrors, SkipsFailures;

    private $estados;

    public function __construct()
    {
        $this->estados = Estado::pluck('id', 'nombre');
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Municipio([
            'nombre' => $row['d_mnpio'],
            'slug' => Str::slug($row['d_mnpio']),
            'estado_id' => $this->estados[mb_strtoupper($row['d_estado'], 'UTF-8')],
        ]);
    }

    /**
     * @return Int The chunkSize() method returns the number of items to be processed at a time.
     */
    public function chunkSize(): Int
    {
        return 1000;
    }

    /**
     * @return array An array of rules.
     */
    public function rules(): array
    {
        return [
            //'d_mnpio' => ['unique:municipios,nombre', 'required'],
            'd_mnpio' => ['required'],
            'd_estado' => ['exists:estados,nombre', 'required'],
        ];
    }
}
