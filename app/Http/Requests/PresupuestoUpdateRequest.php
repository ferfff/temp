<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class PresupuestoUpdateRequest extends FormRequest
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
            'folio' => ['nullable', 'unique:presupuestos,folio,' . $this->presupuesto->id],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'monto' => ['required', 'numeric'],
            'fecha_recepcion' => ['required', 'date_format:Y-m-d'],
            'comentario' => ['required'],
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
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'cliente_id' => Cliente::where('razon_social', $this->cliente_id)->withTrashed()->first()->id ?? null,
            'monto' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto)),
        ]);
    }
}
