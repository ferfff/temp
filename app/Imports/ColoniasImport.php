<?php

namespace App\Imports;

use App\Models\CodigoPostal;
use App\Models\Colonia;
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

class ColoniasImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithValidation, SkipsOnError, SkipsOnFailure
{

    use Importable, SkipsErrors, SkipsFailures;

    private $codigos_postales;

    public function __construct()
    {
        $this->codigos_postales = CodigoPostal::pluck('id', 'CP');
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Colonia([
            'nombre' => $row['d_asenta'],
            'slug' => Str::slug($row['d_codigo'] . '-' . $row['d_tipo_asenta'] . '-' . $row['d_asenta']),
            'tipo_asentamiento' => $row['d_tipo_asenta'],
            'codigo_postal_id' => $this->codigos_postales[mb_strtoupper($row['d_codigo'], 'UTF-8')],
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
            'd_asenta' => 'required',
            'd_tipo_asenta' => 'required',
            'd_codigo' => 'required',
        ];
    }
}
