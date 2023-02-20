<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroPatronalUpdateRequest extends FormRequest
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
            'razon_social' => ['required', 'unique:registros_patronales,razon_social,' . $this->registros_patronale->id],
            'razon_comercial' => ['required', 'unique:registros_patronales,razon_comercial,' . $this->registros_patronale->id],
            'RFC' => ['required', 'unique:registros_patronales,RFC,' . $this->registros_patronale->id],
            'registro_patronal_imss' => 'required',
            'logotipo' => '',
        ];
    }
}
