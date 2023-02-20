<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Presupuesto;
use Illuminate\Foundation\Http\FormRequest;

class SirocStoreRequest extends FormRequest
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
            'folio' => ['nullable', 'unique:sirocs,folio'],
            'descripcion' => 'required',
            'cliente_id' => ['required', 'exists:clientes,id'],
            'presupuesto_id' => ['nullable', 'exists:presupuestos,id'],
            'imss' => 'required',
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
        $presupuesto = Presupuesto::where('folio', $this->folio)->get();
        $this->merge([
            'presupuesto_id' => count($presupuesto) > 0 ? $presupuesto->first()->id : null,
            'cliente_id' => Cliente::where('razon_social', $this->cliente_id)->withTrashed()->first()->id,
        ]);
    }
}
