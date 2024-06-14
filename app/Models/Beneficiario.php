<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'sc_beneficiarios';
    public $timestamps = false;
    protected $fillable = [
        'sc_actividad_id',
        'num_beneficiarios',
        'genero'
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
