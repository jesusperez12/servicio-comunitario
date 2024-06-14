<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = 'sc_asesores';
    public $timestamps = true;
    protected $fillable = [
        'sede_id',
        'sc_comunidad_id',
        'ci',
        'firstname',
        'middlename',
        'primary_lastname',
        'second_lastname',
    ];

    public function autoridades()
    {
        return $this->hasMany('App\Authority');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function proyectos()
    {
        return $this->hasMany('App\Proyecto');
    }

    public function periodos()
    {
        return $this->hasMany('App\Periodo', 'sede_id');
    }

    public function prestadores()
    {
        return $this->hasMany('App\Prestador', 'sede_id');
    }
}
