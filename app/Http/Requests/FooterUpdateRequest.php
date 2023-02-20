<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterUpdateRequest extends FormRequest
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
            'aviso_privacidad' => ['required'],
            'aviso_privacidad_resumen' => ['required', 'max:255'],
            'ubicacion' => ['required', 'max:50'],
            'email' => ['required', 'max:50'],
            'telefono' => ['required', 'max:10'],
            'facebook_url' => ['required_if:facebook_activo,on', 'max:255'],
            'facebook_activo' => ['boolean'],
            'twitter_url' => ['required_if:twitter_activo,on', 'max:255'],
            'twitter_activo' => ['boolean'],
            'instagram_url' => ['required_if:instagram_activo,on', 'max:255'],
            'instagram_activo' => ['boolean'],
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
            'aviso_privacidad' => 'aviso de privacidad',
            'aviso_privacidad_resumen' => 'resumen del aviso de privacidad',
            'facebook_url' => 'link de facebook',
            'twitter_url' => 'link de twitter',
            'instagram_url' => 'link de instagram',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'facebook_url' => 'El campo :facebook_url es obligatorio cuando se :facebook_activo',
            'twitter_url' => 'El campo :twitter_url es obligatorio cuando se :twitter_activo',
            'instagram_url' => 'El campo :twitter_url es obligatorio cuando :instagram_url',
        ];
    }

    /* A method that is called before validation. It is used to modify the request before validation. */
    public function prepareForValidation()
    {
        $this->merge([
            'facebook_activo' => isset($this->facebook_activo) ? 1 : 0,
            'facebook_url' => $this->facebook_activo == 'on' ? trim($this->facebook_url) : '',
            'instagram_activo' => isset($this->instagram_activo) ? 1 : 0,
            'instagram_url' => $this->instagram_activo == 'on' ? trim($this->instagram_url) : '',
            'twitter_activo' => isset($this->twitter_activo) ? 1 : 0,
            'twitter_url' => $this->twitter_activo == 'on' ? trim($this->twitter_url) : '',
        ]);
    }
}
