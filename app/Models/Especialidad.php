<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    protected $primaryKey = 'cod';
    public $incrementing = false;

    public function users() {
        return $this->hasMany('App\User', 'especialidad_cod');
    } 

    public function proyectos() {
        return $this->hasMany('App\Proyecto', 'especialidad_cod');
    }
}
