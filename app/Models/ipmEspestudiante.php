<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ipmEspestudiante extends Model
{
    protected $connection = 'bdestipm6';
   public $timestamps = false;
    protected $table='espe_estud';

    protected $fillable =['id','estudiante_id', 'programa_id', 
    'sede_id', 'especialidad_id','cohorte_id','ingreso_id','lapso_id',
    'situa_id','fecha_ingreso','activo','observacion','subsede_id','indice'];
}
