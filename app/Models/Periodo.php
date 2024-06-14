<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'sc_periodos';
    public $timestamps = false;
    protected $fillable = [
        'sede_id',
        'corte',
        'inicio',
        'fin'
    ];

    public function users() {
        return $this->belongsToMany('App\User', 'sc_user_proyecto', 'periodo_id', 'user_id')
        ->withPivot('id','sede_id','proyecto_id','status','total_hours')->withTimestamps();
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Proyecto', 'sc_user_proyecto', 'periodo_id', 'proyecto_id')
        ->withPivot('id','sede_id','user_id','status','total_hours')->withTimestamps();
    }

    public function actividades() 
    {
        return $this->hasMany('App\Actividad', 'sc_periodo_id');
    }

    public function grupos() 
    {
        return $this->hasMany('App\Grupo', 'sc_periodo_id');
    }
    
    public function comunidades() 
    {
        return $this->hasMany('App\Comunidad', 'sc_preriodo_id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'sede_id');
    }
}
