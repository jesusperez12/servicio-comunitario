<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sedes';
    public $timestamps = false;
    protected $fillable = [
        'cod_sede',
        'nombsede',
        'nomcorto',
        'activo',
        'tipo',
        'ciudad',
        'principalsede',
    ];

    public function autoridades()
    {
        return $this->hasMany('App\Authority', 'sede_id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'sede_id');
    }

    public function proyectos()
    {
        return $this->hasMany('App\Proyecto', 'sede_id');
    }

    public function periodos()
    {
        return $this->hasMany('App\Periodo', 'sede_id');
    }

    public function prestadores()
    {
        return $this->hasMany('App\Prestador', 'sede_id');
    }

    public function actividades()
    {
        return $this->hasMany('App\Actividad', 'sede_id');
    }

    public function comunidades()
    {
        return $this->hasMany('App\Comunidad', 'sede_id');
    }

    public function grupos()
    {
        return $this->hasMany('App\Grupo', 'sede_id');
    }
}
