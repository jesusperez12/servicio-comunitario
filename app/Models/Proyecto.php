<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nombre_proyecto',
        'linea_accion',
        'descripcion',
        'especialidad_cod',
        'fundamentacion',
        'proposito',
        'competencia',
        'metodologia',
        'created_at',
        'updated_at'
    ];

    public function actividades() {
        return $this->hasMany('App\Models\Actividad', 'proyecto_id');
    }

    public function referencias()
    {
        return $this->hasMany('App\Models\Referencia', 'proyecto_id');
    }

    public function grupos()
    {
        return $this->hasMany('App\Models\Grupo', 'proyecto_id');
    }

    public function prestadores()
    {
        return $this->hasMany('App\Models\Prestador', 'proyecto_id');
    }

    public function comunidades()
    {
        return $this->hasMany('App\Models\Comunidad', 'proyecto_id');
    }

    public function especialidad() {
        return $this->belongsTo('App\Models\Especialidad', 'especialidad_cod');
    }
    
    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'sc_user_proyecto', 'proyecto_id', 'user_id')
        ->withPivot('id','sede_id','periodo_id','total_hours','status')->withTimestamps();
    }

    public function periodos() {
        return $this->belongsToMany('App\Models\Periodo', 'sc_user_proyecto', 'proyecto_id', 'periodo_id')
        ->withPivot('id','sede_id','user_id','total_hours','status')->withTimestamps();
    }

    public function sede() {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }

    public function bundlePivot()
    {
        return $this->hasOne('App\Models\PivotUserProject', 'proyecto_id', 'id');
    }
}
