<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localities';
    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }
}
