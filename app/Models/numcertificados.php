<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numcertificados extends Model
{
    use HasFactory;

      protected $table = 'numcertificados';
    public $timestamps = true;
    protected $fillable = [
        'sede_id',
        'certificados',
        'prestador_id',
        'Aprobado'
    ];
}
