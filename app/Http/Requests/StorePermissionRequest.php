<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePermissionRequest extends Request
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
            'permission' => 'bail|required|unique:permissions,permission,' . Request::get('permission_id'),
            'permission_slug' => 'bail|required|unique:permissions,permission,' . Request::get('permission_id'),
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio',
            'unique' => 'El elemento ya está en uso.',
            'digits' => 'El campo debe ser un número de :digits dígitos.',
            'string' => 'El campo debe contener solo caracteres.',
            'boolean' => 'El campo debe ser verdadero o falso.',
            'numeric' => 'El campo debe ser un numero.',
            'date_format' => 'El campo no corresponde con el formato de fecha :format.',
            'max' => [
                'numeric' => 'El campo debe ser :max como máximo.',
                'file'    => 'El archivo debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo debe contener :max caracteres como máximo.',
                'array'   => 'El campo debe contener :max elementos como máximo.',
            ],
            'min' => [
                'numeric' => 'El campo debe tener al menos :min.',
                'file'    => 'El archivo debe pesar al menos :min kilobytes.',
                'string'  => 'El campo debe contener al menos :min caracteres.',
                'array'   => 'El campo no debe contener más de :min elementos.',
            ]
        ];
    }
}
