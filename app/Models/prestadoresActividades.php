<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prestadoresActividades extends Model
{
      protected $table = 'sc_prestador_sc_actividad';
    public $timestamps = false;
       protected $fillable = [
        'sc_prestador_id',
        'sc_actividad_id',
        'grupo_id'
    ];


}
