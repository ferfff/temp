<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ControlObraStoreRequest extends FormRequest
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
            'clave' => 'required',
            'partida' => 'required',
            'unidad' => 'required',
            'cantidad' => 'required',
            'precio_unitario' => 'required',
            'grupo' => 'required',
            'importe' => 'required',
            'contrato_id' => 'required',
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
            'contrato_id' => 'contrato',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            //
        ]);
    }
}
