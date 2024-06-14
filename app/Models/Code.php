<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public function phones() {
        return $this->hasMany('\App\Phone', 'code_id');
    }
}
