<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Presupuesto;
use App\Models\Siroc;
use Illuminate\Foundation\Http\FormRequest;

class ContratoStoreRequest extends FormRequest
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
            'folio' => ['required', 'unique:contratos,folio'],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'fecha_firma' => ['required', 'date_format:Y-m-d'],
            'fecha_inicio' => ['required', 'date_format:Y-m-d'],
            'fecha_cierre_siroc' => ['nullable', 'date_format:Y-m-d'],
            'fecha_termino' => ['required', 'date_format:Y-m-d'],
            'monto' => ['numeric'],
            'monto_anticipo' => ['required', 'numeric'],
            'importe_contratado' => ['required', 'numeric'],
            'suministros' => ['required', 'numeric'],
            'total_contrato' => ['required', 'numeric'],
            'porcentaje_amortizacion_anticipo' => ['required', 'numeric'],
            'concepto_adenda' => 'required',
            'descripcion_contrato' => 'required',
            'licencia' => 'required',
            'calle' => 'required',
            'no_ext' => 'required',
            'no_int' => '',
            'colonia' => 'required',
            'localidad' => 'required',
            'referencia' => '',
            'municipio_id' => ['required', 'exists:municipios,id'],
            'estado_id' => ['required', 'exists:estados,id'],
            'codigo_postal' => ['required', 'numeric'],
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
        $folio = $this->folio;
        $cliente = Cliente::where('razon_social', $this->cliente_id)->withTrashed()->first()->id ?? null;

        if (str_contains($this->base, 'Presupuesto')) {
            $folio = Presupuesto::where('id', $this->folio_base)->first()->folio;
            $cliente = Presupuesto::where('id', $this->folio_base)->first()->cliente_id;
        } elseif (str_contains($this->base, 'Siroc')) {
            $folio = Siroc::where('id', $this->folio_base)->first()->folio;
            $cliente = Siroc::where('id', $this->folio_base)->first()->cliente_id;
        }

        $this->merge([
            'folio' => $folio,
            'tipo' => $this->tipo == "true" ? 1 : 0,
            'cliente_id' => $cliente,
            'fecha_firma' => str_contains($this->base, 'Siroc') ? Siroc::where('id', $this->folio_base)->first()->fecha_firma : $this->fecha_firma,
            'fecha_cierre_siroc' => str_contains($this->base, 'Siroc') ? Siroc::where('id', $this->folio_base)->first()->fecha_cierre_siroc : $this->fecha_cierre_siroc,

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
            'model_id' => $this->folio_base,
            'model_type' => $this->base != null ? "App\\Models\\$this->base" : null,
        ]);
    }
}
