<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
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
            'role_id' => 'bail|required|numeric|unique:users,role_id,' . Request::get('user_id') . ',id,sede_id,' . Request::get('sede_id'),
            'ci' => 'bail|required|numeric|unique:users,id,' . Request::get('user_id'),
            'firstname' => 'bail|required|string|max:100',
            'middlename' => 'bail|string|max:100',
            'primary_lastname' => 'bail|required|string|max:100',
            'second_lastname' => 'bail|string|max:100',
            'address' => 'bail|required|string|max:100',
            'locality' => 'bail|required|string|max:25',
            'province' => 'bail|required|string|max:40',
            'date_birth' => 'bail|date_format:d/m/Y',
            'email' => 'bail|required|email',
            'speciality' => 'string',
            'password' => 'bail|string|min:8',
            'status' => 'bail|required|boolean',
            'phones.*' => 'bail|required|numeric|digits:7|unique:phones,id,' . Request::get('phones_id.*')
        ];
    }
}
