<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostVentaStoreRequest extends FormRequest
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
            'nombre' => 'required',
            'contrato_id' => ['required', 'exists:contratos,id'],
            'monto' => ['required', 'numeric'],
            'fecha_recepcion' => ['required', 'date_format:Y-m-d'],
            'archivo' => 'required',
        ];
    }
}
