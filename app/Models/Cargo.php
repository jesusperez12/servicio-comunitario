<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    public $timestamps = false;

    public function autoridad()
    {
        return $this->hasMany('App\Authority', 'cargo_id');
    }
}
