<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';

  public $timestamps = false;

  protected $fillable = [
  	'role', 'role_slug', 'description'
  ];

  public function users()
  {
    return $this->hasMany('App\User');
  }

  public function permissions()
  {
    return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
  }
}
