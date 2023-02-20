<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class ContratoUpdateRequest extends FormRequest
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
            'folio' => ['required', 'unique:contratos,folio,' . $this->contrato->id],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'fecha_firma' => ['required', 'date_format:Y-m-d'],
            'fecha_inicio' => ['required', 'date_format:Y-m-d'],
            'fecha_cierre_siroc' => ['sometimes', 'date_format:Y-m-d'],
            'fecha_termino' => ['required', 'date_format:Y-m-d'],
            'monto' => ['numeric'],
            'monto_anticipo' => ['required', 'numeric'],
            'importe_contratado' => ['required', 'numeric'],
            'suministros' => ['required', 'numeric'],
            'total_contrato' => ['required', 'numeric'],
            'porcentaje_amortizacion_anticipo' => ['required', 'numeric'],
            'licencia' => 'required',
            'calle' => 'required',
            'no_ext' => 'required',
            'no_int' => '',
            'colonia' => 'required',
            'localidad' => 'required',
            'referencia' => '',
            'municipio_id' => ['required', 'exists:municipios,id'],
            'estado_id' => ['required', 'exists:estados,id'],
            'codigo_postal' => ['required'],
            'permite_deductivas' => '',
            'activo' => '',
            'porcentaje_retencion' => ['required', 'numeric'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'cliente_id' => 'cliente',
            'municipio_id' => 'municipio',
            'estado_id' => 'estado',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'tipo' => $this->tipo == "true" ? 1 : 0,
            'cliente_id' => Cliente::where('razon_social', $this->cliente_id)->withTrashed()->first()->id ?? null,
            'monto' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto)),
            'monto_anticipo' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto_anticipo)),
            'importe_contratado' => floatval(preg_replace("/[^-0-9\.]/", "", $this->importe_contratado)),
            'suministros' => floatval(preg_replace("/[^-0-9\.]/", "", $this->suministros)),
            'total_contrato' => floatval(preg_replace("/[^-0-9\.]/", "", $this->total_contrato)),
            'permite_deductivas' => $this->permite_deductivas == "true" ? 1 : 0,
            'permite_aditivas' => $this->permite_aditivas == "true" ? 1 : 0,
            'activo' => isset($this->activo) ? 1 : 0,
            'porcentaje_retencion' => (float) str_replace('', '%', $this->porcentaje_retencion),
            'porcentaje_amortizacion_anticipo' => (float) str_replace('', '%', $this->porcentaje_amortizacion_anticipo),
        ]);
    }
}
