<?php

namespace App\Http\Requests;

use App\Models\Contrato;
use App\Models\Estimacion;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EstimacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_estimacion' => ['required', 'date_format:Y-m-d'],
            'no_estimacion' => ['required', 'numeric'],
            'contrato_id' => ['required', 'exists:contratos,id'],
            'monto_ejecutar' => ['required', 'numeric'],
            'monto_facturar' => ['required', 'numeric'],
            'retencion_monto' => ['required', 'numeric'],
            'retencion_porcentaje' => ['required', 'numeric'],
            'total_facturar' => ['required', 'numeric'],
            'amortizacion_monto' => ['required', 'numeric'],
            'amortizacion_porcentaje' => ['required', 'numeric'],
        ];
    }

    /* A method that is called before validation. It is used to modify the request before validation. */
    public function prepareForValidation()
    {
        $estimacion = Estimacion::whereRelation('contrato', 'uid', $this->contrato_id)->latest()->first();
        $numero = 1;
        if ($estimacion != null) {
            $numero = $estimacion->estado == 'Rechazada' || $estimacion->estado == 'Cancelada' ? $estimacion->no_estimacion : $estimacion->no_estimacion + 1;
        }
        $this->merge([
            'fecha_estimacion' => Carbon::parse($this->fecha_estimacion)->format('Y-m-d'),
            'no_estimacion' => $numero,
            'monto_ejecutar' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto_ejecutar)),
            'acumulada' => floatval(preg_replace("/[^-0-9\.]/", "", $this->acumulada)),
            'monto_facturar' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto_facturar)),
            'retencion_monto' => floatval(preg_replace("/[^-0-9\.]/", "", $this->retencion_monto)),
            'retencion_porcentaje' => floatval(preg_replace("/[^-0-9\.]/", "", $this->retencion_porcentaje)),
            'amortizacion_monto' => floatval(preg_replace("/[^-0-9\.]/", "", $this->amortizacion_monto)) ?? 0,
            'amortizacion_porcentaje' => floatval(preg_replace("/[^-0-9\.]/", "", $this->amortizacion_porcentaje)) ?? 0,
            'total_facturar' => floatval(preg_replace("/[^-0-9\.]/", "", $this->total_facturar)),
            'contrato_id' => Contrato::where('uid', $this->contrato_id)->first()->id,
            'estado' => 'Revision',
        ]);
    }
}
