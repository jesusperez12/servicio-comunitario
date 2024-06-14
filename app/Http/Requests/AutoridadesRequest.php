<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoridadesRequest extends FormRequest
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
         
            'cargo_id' => 'required',
             'autoridad' => 'required',
       
        ];
    }

      public function messages()
    {
          return [  
        
             'cargo_id.required' => 'El Cargo es requerido.',
        
            'autoridad.required' =>  'el Nombre es requerido'
          
        ];

    }
}
