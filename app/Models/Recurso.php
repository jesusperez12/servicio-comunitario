<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'sc_recursos';
    public $timestamps = false;
    protected $fillable = [
        'sc_actividad_id',
        'recurso',
        'tipo'
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
