<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Prestador extends Authenticatable
{
     protected $quard ='sc_prestadores';

     
    protected $table = 'sc_prestadores';
    public $timestamps = false;

    protected $fillable = [
        'sede_id',
        'sc_user_proyecto_id',
        'user_id',
        'proyecto_id',
        'sc_periodo_id',
        'grupo_id',
        'ci',
        'firstname',
        'middlename',
        'primary_lastname',
        'second_lastname',
        'especialidad_cod',
        'hrs_comunitarias'
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto', 'proyecto_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo', 'grupo_id');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'sc_periodo_id');
    }

    public function actividades()
    {
        return $this->belongsToMany('App\Models\Actividad', 'sc_prestador_sc_actividad', 'sc_prestador_id', 'sc_actividad_id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }

    public function especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad', 'especialidad_cod');
    }
}
