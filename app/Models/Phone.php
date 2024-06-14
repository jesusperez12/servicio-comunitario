<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    public $timestamps = false;
    
    /**
     * Campos rellenables de la tabla
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code_id',
        'number'
    ];
    
    /**
     * Relationship Many to One
     * @return model relation
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function code() {
        return $this->belongsTo('\App\Models\Code');
    }
}
