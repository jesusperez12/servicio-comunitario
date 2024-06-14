<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $table = 'authorities';
    public $timestamps = false;
    protected $fillable = [
        'sede_id',
        'cargo_id',
        'autoridad'
    ];

    public function cargo()
    {
        return $this->belongsTo('App\Models\Cargo');
    }

    public function sede()
    {
        return $this->belongsTo('App\Models\Cargo');
    }
}
