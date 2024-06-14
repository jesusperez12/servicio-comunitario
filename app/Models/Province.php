<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function localities()
    {
        return $this->hasMany('App\Localidad', 'province_id');
    }
}
