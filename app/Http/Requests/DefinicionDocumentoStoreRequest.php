<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DefinicionDocumentoStoreRequest extends FormRequest
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
            'nombre' => ['required', 'unique:definicion_documentos,nombre', 'max:50'],
            'obligatorio' => 'boolean',
            'solicita_aprobacion' => 'boolean',
            'solicita_comentario' => 'boolean',
            'ciclo_id' => 'required',
            'multiple' => 'boolean',
            'referencia' => 'boolean',
            'seguimiento' => 'boolean',
            'activo' => 'boolean',
            'aplazamiento' => 'boolean',
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
            'ciclo_id' => 'Requerido en',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'obligatorio' => $this->obligatorio == "true" ? 1 : 0,
            'solicita_aprobacion' => $this->solicita_aprobacion == "true" ? 1 : 0,
            'solicita_comentario' => $this->solicita_comentario == "true" ? 1 : 0,
            'multiple' => $this->multiple == "true" ? 1 : 0,
            'referencia' => $this->referencia == "true" ? 1 : 0,
            'seguimiento' => $this->seguimiento == "true" ? 1 : 0,
            'aplazamiento' => $this->aplazamiento == "true" ? 1 : 0,
            'activo' => $this->activo == "true" ? 1 : 0,
        ]);
    }
}
