<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProviderRequest extends Request
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
        return  [
            'ci' => 'bail|required|numeric|unique:sc_prestadores,ci,' . $this->request->get('provider_id'),
            'firstname' => 'bail|required|string|max:50',
            'primary_lastname' => 'bail|required|string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'La cédula \'' . $this->request->get('ci') . '\' ya existe.'
        ];
    }
}
