<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JornalRequest extends FormRequest
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
            'NSS' => 'required',
            'nombre_completo' => 'required',
            'departamento' => 'required',
            'curp' => 'required',
            'dias_laborados' => 'required',
            'SDI' => 'required',
        ];
    }
}
