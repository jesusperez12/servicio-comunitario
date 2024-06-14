<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestadoresRequest extends FormRequest
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
       return $rules = [
            'ci' => 'required|distinct|unique:sc_prestadores',
              'proyecto_id' => 'required',
                'especialidad' => 'required',
                'grupo' => 'required'
        ];
    }

    public function messages()
    {
          return [  
        
            'proyecto_id' => 'El proyecto es requerido.',
            'especialidad' => 'La especialidad es requerido.',
             'grupo' => 'El grupo o seccion es requerido.',
        
            'ci' => [
               
                 'required' => 'la campo prestador debe ser requerido',
                'distinct'    => 'El campo cédula esta duplicado.',
                'unique'  => 'La cédula ya existe.'
            ]
        ];

    }
}
