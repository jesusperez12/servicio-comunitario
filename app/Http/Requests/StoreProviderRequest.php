<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends Request
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
            'ci.*' => 'required|numeric|distinct|unique:sc_prestadores',
            'firstname.*' => 'required|string|max:50',
            'primary_lastname.*' => 'required|string|max:50',
              'proyecto_id.*' => 'required',
                'especialidad.*' => 'required',
                'grupo.*' => 'required'
        ];
    }

    public function messages()
    {
          return [  
        
            'proyecto_id' => 'El proyecto es requerido.',
            'especialidad' => 'La especialidad es requerido.',
             'grupo' => 'El grupo o seccion es requerido.',
            'firstname' => [
                'string'  => 'El campo debe contener :max caracteres como máximo.',
                'required'   => 'El campo es requerido.',
            ],
            'ci' => [
                'numeric' => 'El campo debe ser numerico',
                 'required' => 'la campo prestador debe ser requerido',
                'distinct'    => 'El campo cédula esta duplicado.',
                'unique'  => 'La cédula ya existe.',
            ]
        ];




        /*$messages = [];
        foreach($this->request->get('ci') as $key => $val)
        {
            // Mensajes de Validación de Cédula
            $messages['ci.'.$key.'.unique'] = 'La cédula \'' . $val . '\' ya existe.';
            $messages['ci.'.$key.'.distinct'] = 'El campo cédula \'' . ($key+1) . '\' esta duplicado con valor \''. $val . '\'';
            $messages['ci.'.$key.'.required'] = 'El campo cédula '.($key+1).' es requerido.';
            $messages['ci.'.$key.'.numeric'] = 'El campo cédula '.($key+1).' debe ser numérico.';
            //$messages['ci.'.$key.'.exists'] = 'El estudiante con cédula <b>'.$val.'</b> no se encuentra inscrito.';
            // Mensajes de Validación de Primer nombre
            $messages['firstname.'.$key.'.required'] = 'El campo \'Primer nombre '.($key+1).'\' es requerido.';
            $messages['firstname.'.$key.'.string'] = 'El campo \'Primer nombre '.($key+1).' debe contener sólo caracteres.';
            $messages['firstname.'.$key.'.max'] = 'El campo \'Primer nombre '.($key+1).' debe contener :max caracteres como máximo.';
            // Mensajes de Validación de Segundo nombre
            $messages['primary_lastname.'.$key.'.required'] = 'El campo \'Primer apellido '.($key+1).'\' es requerido.';
            $messages['primary_lastname.'.$key.'.string'] = 'El campo \'Primer apellido '.($key+1).' debe contener sólo caracteres.';
            $messages['primary_lastname.'.$key.'.max'] = 'El campo \'Primer apellido '.($key+1).' debe contener :max caracteres como máximo.';
            $messages['proyecto_id.'.$key.'.required'] = 'El campo \'Proyecto '.($key+1).'\' es requerido.';
            $messages['especialidad.'.$key.'.required'] = 'El campo \'Especialidad '.($key+1).'\' es requerido.';
        }

        return $messages;*/
    }
}
