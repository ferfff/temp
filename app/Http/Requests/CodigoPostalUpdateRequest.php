<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodigoPostalUpdateRequest extends FormRequest
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
            'CP' => ['required', 'numeric', 'unique:codigos_postales,CP,' . $this->codigos_postale->id],
            'municipio_id' => ['required', 'exists:municipios,id'],
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
            'CP' => 'codigo postal',
            'municipio_id' => 'municipio',
        ];
    }
}
