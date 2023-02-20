<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'max:20'],
            'apellido_paterno' => ['max:20'],
            'apellido_materno' => ['max:20'],
            'email' => ['sometimes', 'required', 'email', 'unique:users,email,' . $this->perfil->id, 'regex:/^[A-Za-z1-9@.]+$/', 'string', 'max:50'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'password' => 'contraseña',
        ];
    }
}
