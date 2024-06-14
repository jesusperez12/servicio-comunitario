<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ipcEstudiante extends Model
{
    protected $connection = 'bdestipc';
    public $timestamps = false;
    protected $table='estudiante';

    protected $fillable =['id','cedula', 'primer_nombre', 
    'segundo_nombre', 'primer_apellido','segundo_apellido','nacionalidad','fecha_nacimiento',
    'sexo','direccion','telefono_movil','telefono_local','email','estado_civil','pais_id','estado_id',
    'municipio_id','ciudad_id','etnia_id','discapacidad_id','tiposestudiante_id','plantel_graduado','clasif_plantel',
    'fecha_graduado','num_rusnies','nivel_economico'];
}
