<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotaCreditoRequest extends FormRequest
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
            'emisor' => ['required', 'regex:/^([A-ZÑa-zñ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Za-z\d]{3}))$/'],
            'cliente_id' => ['exists:clientes,id'],
            'folio' => ['required', Rule::unique('nota_creditos')->whereNull('deleted_at')],
            'fecha' => ['required', 'date_format:Y-m-d H:i:s'],
            'monto' => ['required', 'numeric'],
            'pdf' => 'required',
            'xml' => 'required',
        ];
    }/**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'cliente_id' => 'RFC',
            'estimacion_id' => 'estimacion',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'fecha' => Carbon::parse($this->fecha)->format('Y-m-d H:i:s'),
            'monto' => floatval(preg_replace("/[^-0-9\.]/", "", $this->monto)),
            'cliente_id' => Cliente::where('RFC', $this->cliente_id)->withTrashed()->first()->id ?? null,
        ]);
    }
}
