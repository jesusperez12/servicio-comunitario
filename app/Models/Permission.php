<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table = 'permissions';

  public $timestamps = false;

  protected $fillable = [
  	'permission', 'permission_slug', 'description'
  ];

  public function roles() 
  {
  	return $this->belongsToMany('App\Role', 'permission_role', 'role_id', 'permission_id');
  }
}
