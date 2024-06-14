<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'sc_grupos';
    public $timestamps = false;
    protected $fillable = [
        'sc_user_proyecto_id',
        'user_id',
        'proyecto_id',
        'sc_periodo_id',
        'grupo'
    ];

    public function periodo()
    {
        return $this->belongsTo('App\Periodo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto');
    }

    public function prestadores()
    {
        return $this->hasMany('App\Prestador', 'grupo_id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'sede_id');
    }
}
