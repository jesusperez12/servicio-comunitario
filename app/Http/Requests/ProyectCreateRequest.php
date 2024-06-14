<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectCreateRequest extends FormRequest
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
            'nombre_proyecto' => 'required',
            'descripcion' => 'required',
             'linea_accion' => 'required',
            'fundamentacion' => 'required',
            'proposito' => 'required',
            'competencia' => 'required',
            'metodologia' => 'required',
            'referencias' => 'required',
         
        ];
    }

    public function messages()
    {
        return [
            'nombre_proyecto.required' => 'Este campo es requerido',
            'descripcion.required' => 'Este campo es requerido',
            'linea_accion.required' => 'Este campo es requerido ',
           'fundamentacion.required' => 'Este campo es requerido ',
             'proposito.required' => 'Este campo es requerido ',
           'competencia.required' => 'Este campo es requerido ',
             'metodologia.required' => 'Este campo es requerido ',
            'referencias.required' => 'Este campo es requerido ',
          

        ];
    }
}
