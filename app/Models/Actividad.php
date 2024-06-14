<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'sc_actividades';
    public $timestamps = true;

    protected $fillable = [
        'sede_id',
        'sc_user_proyecto_id',
        'user_id',
        'proyecto_id',
        'sc_periodo_id',
        'fecha',
        'actividad',
        'detalle',
        'direccion',
        'hrs',
        'hrs_temp',
        'impacto_gen'
    ];

    public function recursos()
    {
        return $this->hasMany('App\Models\Recurso', 'sc_actividad_id');
    }

    public function beneficiarios()
    {
        return $this->hasMany('App\Models\Beneficiario', 'sc_actividad_id');
    }

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'sc_periodo_id');
    }

    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }

    public function prestadores()
    {
        return $this->belongsToMany('App\Models\Prestador', 'sc_prestador_sc_actividad', 'sc_actividad_id', 'sc_prestador_id');
    }
}
