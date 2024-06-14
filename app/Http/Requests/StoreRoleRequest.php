<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRoleRequest extends Request
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
            'role' => 'bail|required|unique:roles,id,' . Request::get('role_id'),
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo es obligatorio',
            'unique' => 'El elemento ya está en uso.'
        ];
    }
}
