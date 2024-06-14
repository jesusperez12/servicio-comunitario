<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';
    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'referencia'
    ];

    public function proyecto() {
        return $this->belongsTo('App\Proyecto');
    }
}
