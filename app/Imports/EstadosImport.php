<?php

namespace App\Imports;

use App\Models\Estado;
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

class EstadosImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, SkipsOnError, SkipsOnFailure, ShouldQueue
{

    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Estado([
            'nombre' => $row['d_estado'],
            'slug' => Str::slug($row['d_estado']),
            'curp' => $row['curp'],
        ]);
    }

    /**
     * @return Int The chunkSize() method returns the number of items to be processed at a time.
     */
    public function chunkSize(): Int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'd_estado' => 'required',
            'curp' => '',
        ];
    }
}
