<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColoniaStoreRequest extends FormRequest
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

            'nombre' => ['required', 'unique:colonias,nombre'],
            'tipo_asentamiento' => ['required'],
            'codigo_postal_id' => ['required', 'exists:codigos_postales,id'],
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
            'nombre' => 'colonia',
            'codigo_postal_id' => 'codigo postal',
        ];
    }
}
