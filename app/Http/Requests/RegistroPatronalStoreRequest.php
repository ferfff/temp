<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroPatronalStoreRequest extends FormRequest
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
            'razon_social' => ['required', 'unique:registros_patronales,razon_social'],
            'razon_comercial' => ['required', 'unique:registros_patronales,razon_comercial'],
            'RFC' => ['required', 'unique:registros_patronales,RFC'],
            'registro_patronal_imss' => 'required',
            'logotipo' => '',
        ];
    }
}
