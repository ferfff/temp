<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'razon_social' => ['required', 'unique:clientes,razon_social,' . $this->cliente->id],
            'RFC' => ['required', 'unique:clientes,RFC,' . $this->cliente->id, 'regex:/^([A-ZÑa-zñ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Za-z\d]{3}))$/'],
            'contacto' => 'required',
            'activo' => '',
            'registro_patronal' => ['required'],
            'repse' => 'required',
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
            'RFC' => 'RFC',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'presupuesto' => $this->presupuesto == "true" ? 1 : 0,
            'siroc' => $this->siroc == "true" ? 1 : 0,
            'expediente' => $this->expediente == "true" ? 1 : 0,
        ]);
    }
}
