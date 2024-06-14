<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ActividadRequest extends Request
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
            'proyecto' => 'required',
            'fecha' => 'required',
            'direccion' => 'required|max:150',
            'actividad' => 'required|max:255',
            'detalle' => 'required',
            'duracion' => 'required|numeric',
            'impacto' => 'required|max:255',
            'recursos' => 'required',
            'beneficiarios' => 'required',
            'grupo_id' => 'required',
            'prestadores' => 'required',
            'tipo_beneficiario' => 'required',
            'tipo_recurso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'proyecto.required' => 'la proyecto es requerido',
            'direccion.required' => 'La dirección es requerido',
            'actividad.required' => 'La actividad es requerido',
            'detalle.required' => 'El detalle es requerido',
            'duracion.required' => 'La duración es requerido',
            'impacto.required' => 'El impacto es requerido',
            'recursos.required' => 'Los recursos es requerido',
            'beneficiarios.required' => 'Los beneficiados son requerido',
            'grupo_id.required' => 'El grupo o sección es requerido',
            'prestadores.required' => 'Los prestadores son requerido',
            'tipo_beneficiario.required' => 'El tipo de beneficiario es requerido',
             'tipo_recurso.required' => 'El tipo de recurso es requerido',

               'fecha' => [
                'required' => 'La fecha es requerida',
            ]

        ];
    }
}
