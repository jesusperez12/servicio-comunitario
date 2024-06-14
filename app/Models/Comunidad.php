<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = 'sc_comunidades';
    public $timestamps = true;
    protected $fillable = [
        'sede_id', 
        'sc_user_proyecto_id',
        'user_id',
        'proyecto_id',
        'sc_periodo_id',
        'asesor_id',
        'nombre',
        'direccion',
        'sector',
        'localidad',
        'provincia',
        'state',
        'lugar_prestadores',
        'direccion_lugar'
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

    public function sede()
    {
        return $this->belongsTo('App\Sede', 'sede_id');
    }
}
