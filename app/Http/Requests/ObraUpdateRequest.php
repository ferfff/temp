<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObraUpdateRequest extends FormRequest
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
            'registro_patronal_id' => ['required', 'exists:registros_patronales,id'],
            'clave_obra' => ['required', 'unique:obras,clave_obra,' . $this->obra->id],
            'nombre' => 'required',
        ];
    }
}
