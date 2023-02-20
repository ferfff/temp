<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'max:20'],
            'apellido_paterno' => ['max:20'],
            'apellido_materno' => ['max:20'],
            'email' => ['required', 'email', 'unique:users,email', 'regex:/^[A-Za-z1-9@.]+$/', 'string', 'max:50'],
            'password' => ['required', 'min:8', 'max:30', Password::defaults()],
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
