<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotUserProject extends Model
{
    protected $table = 'sc_user_proyecto';
    public $timestamps = true;
      protected $fillable = [
        'sede_id',
        'user_id',
        'proyecto_id',
        'periodo_id',
        'total_hours',
        'status',
        'finalized_at',
        'user_asignador_id'
        
    ];
}
