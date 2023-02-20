<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Presupuesto;
use Illuminate\Foundation\Http\FormRequest;

class SirocUpdateRequest extends FormRequest
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
            'folio' => ['nullable', 'unique:sirocs,folio,' . $this->siroc->id],
            'descripcion' => 'required',
            'cliente_id' => ['required', 'exists:clientes,id'],
            'presupuesto_id' => ['exists:presupuestos,id', 'nullable'],
            'imss' => 'required',
            'comentario' => 'required',
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
            'presupuesto_id' => 'presupuesto',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'cliente_id' => Cliente::where('razon_social', $this->cliente_id)->withTrashed()->first()->id ?? null,
            'presupuesto_id' => Presupuesto::where('folio', $this->presupuesto_id)->first()->id ?? null,
        ]);
    }
}
