<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametroRequest extends FormRequest
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
            'titulo' => ['sometimes', 'required'],
            'email_smtp' => ['sometimes', 'required'],
            'email_cuenta' => ['sometimes', 'required'],
            'email_password' => ['sometimes', 'required'],
            'email_ssl' => ['sometimes', 'required', 'boolean'],
            'email_puerto' => ['sometimes', 'required', 'integer'],
            'whatsapp_api_key' => ['sometimes', 'required'],
            'whatsapp_account' => ['sometimes', 'required'],
            'whatsapp_dias_valido' => ['sometimes', 'required'],
            'host_app' => ['sometimes', 'required'],

            'dominio_alta_presupuesto' => ['required_if:proceso_alta_presupuesto_uso,true'],

            'dominio_modificado_presupuesto' => ['required_if:proceso_modificado_presupuesto_uso,true'],

            'dominio_autorizado_presupuesto' => ['required_if:proceso_autorizado_presupuesto_uso,true'],

            'dominio_rechazado_presupuesto' => ['required_if:proceso_rechazado_presupuesto_uso,true'],

            'dominio_siroc' => ['required_if:proceso_siroc_uso,true'],

            'dominio_jornales' => ['required_if:proceso_jornales_uso,true'],

            'dominio_estimaciones' => ['required_if:proceso_estimaciones_uso,true'],
            'dominio_estimaciones_cliente' => ['required_if:proceso_estimaciones_cliente_uso,true'],
            'dominio_estimaciones_pendiente' => ['required_if:proceso_estimaciones_pendiente_uso,true'],

            'dominio_expedientes' => ['required_if:proceso_expedientes_uso,true'],
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
            'dominio_alta_presupuesto.required_if' => 'El campo dominio alta presupuesto es requerido si el proceso alta presupuesto es Interno',
            'dominio_modificado_presupuesto.required_if' => 'El campo dominio modificado presupuesto es requerido si el proceso modificado presupuesto es Interno',
            'dominio_autorizado_presupuesto.required_if' => 'El campo dominio autorizado presupuesto es requerido si el proceso autorizado presupuesto es Interno',
            'dominio_rechazado_presupuesto.required_if' => 'El campo dominio rechazado presupuesto es requerido si el proceso rechazado presupuesto es Interno',
            'dominio_siroc.required_if' => 'El campo dominio siroc es requerido si el proceso siroc es Interno',
            'dominio_jornales.required_if' => 'El campo dominio jornales es requerido si el proceso jornales es Interno',
            'dominio_estimaciones.required_if' => 'El campo dominio estimacion es requerido si el proceso estimacion es Interno',
            'dominio_estimaciones_cliente.required_if' => 'El campo dominio estimacion envio al cliente es requerido si el proceso estimacion es Interno',
            'dominio_estimaciones_pendiente.required_if' => 'El campo dominio estimacion pendiente de pago es requerido si el proceso estimacion es Interno',
            'dominio_expedientes.required_if' => 'El campo dominio expediente es requerido si el proceso expediente es Interno',
        ];
    }

    public function prepareForValidation()
    {
        $ssl = $this->parametro->email_ssl;

        if (isset($this->email_ssl)) {
            $ssl = $this->email_ssl == "true" ? 1 : 0;
        }

        $this->merge([
            'email_ssl' => $ssl,
            'iva' => isset($this->iva) ? floatval(preg_replace("/[^-0-9\.]/", "", $this->iva)) : $this->parametro->iva,
        ]);
    }
}
