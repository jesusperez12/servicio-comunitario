<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValiCertificadoRequest extends FormRequest
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
            'ci' => 'required',
             'certificate_code' => 'required',
        ];
    }

     public function messages()
    {
          return [  
        
             'certificate_code.required' => 'El certificado es requerido.',
        
            'ci.required' =>  'la cedula es requerido'
          
        ];

    }
}
