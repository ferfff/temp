<?php

namespace App\Http\Requests;

use App\Models\Contrato;
use Illuminate\Foundation\Http\FormRequest;

class ExpedienteStoreRequest extends FormRequest
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
            'nombre' => '',
            'ruta' => '',
            'comentario' => 'required',
            'documento_id' => ['nullable', 'exists:definicion_documentos,uuid'],
            'contrato_id' => ['required', 'exists:contratos,id'],
            'grupo' => ['numeric', 'sometimes', 'nullable'],
            'seguimiento' => ['date_format:Y-m-d', 'after:' . Now()->format('Y-m-d'), 'nullable'],
            'file' => 'required',
            'nodo_id' => ['exists:expedientes,id', 'nullable'],
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
            'documento_id' => 'Documento',
        ];
    }

    /* A method that is called before validation. It is used to modify the request before validation. */
    public function prepareForValidation()
    {
        $this->merge([
            'contrato_id' => Contrato::where('uid', $this->contrato_id)->first()->id,
        ]);
    }
}
