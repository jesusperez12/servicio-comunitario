<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsesorComunityRequest extends FormRequest
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
            'ci' => 'required|numeric|digits_between:7,8|unique:sc_asesores',
            'firstname' => 'required|alpha',
           // 'middlename' => 'required|alpha',
            'primary_lastname' => 'required|alpha',
           // 'second_lastname' => 'required|alpha',
            'phones' => 'required',
            'comunidad' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'direccion' => 'required',
            'state' => 'required',
            'province' => 'required',
            'locality' => 'required',
            'lugar_prestadores' => 'required|regex:/^[\pL\s\-]+$/u',
            'direccion_lugar' => 'required',
            'sector' => 'required',
        ];
    }

      public function messages()
    {
        return [
            'ci.required' => 'la cedula es requerido ',
            'ci.unique' => 'la cedula ya fue registrada ',
            'firstname.required' => 'El nombre es requerido ',
            'primary_lastname.required' => 'El Apellido es requerido',
            'phones.required' => 'El numero de telefono es requerido ',
            'state.required' => 'El estado es requerido ',
            'province.required' => 'La provicia es requerido ',
            'locality.required' => 'La localidad es requerido ',
            'comunidad.required' => 'La comunidad es requerido ',
            'direccion.required' => 'La Dirección es requerido ',
            'lugar_prestadores.required' => 'El lugar de acampar es requerido ',
            'direccion_lugar.required' => 'El direccion del lugar de acampar es requerido ',
             'sector.required' => 'El sector es requerido ',

        ];
    }
}
