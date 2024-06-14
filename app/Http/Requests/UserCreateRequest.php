<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'ci' => 'required|min:7|max:8',
            'firstname' => 'required',
            'primary_lastname' => 'required',
            'email' => 'required|email|unique:users',
             'date_birth' => 'required',
            'password' => 'required',
            'address' => 'required',
            'state' => 'required',
            'province' => 'required',
            'locality' => 'required',
            'phones' => 'required',
            'sede_id' => 'required',
            'role_id' => 'required',
            'status' => 'required',
            'gender' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ci.required' => 'la cedula es requerido amig@',
            'firstname.required' => 'El nombre es requerido amig@',
            'primary_lastname.required' => 'El Apellido es requerido amig@',
            'date_birth.required' => 'La fecha de nacimiento es requerido ',
            'address.required' => 'La dirección es requerido ',
            'state.required' => 'El estado es requerido ',
            'province.required' => 'La provicia es requerido ',
            'locality.required' => 'La localidad es requerido ',
            'phones.required' => 'El numero de telefono es requerido ',
            'sede_id.required' => 'La sede es requerido ',
            'role_id.required' => 'El rol requerido ',
            'status.required' => 'El estatus es requerido ',
            'gender.required' => 'El genero es requerido ',

        ];
    }
}
