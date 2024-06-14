<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'users';
    protected $dates = ['deleted_at'];

    public $timestamps = true;
    
     protected $fillable = [
        'role_id',
        'ci',
        'firstname',
        'middlename',
        'primary_lastname',
        'second_lastname',
        'gender',
        'username',
        'address',
        'locality',
        'province',
        'date_birth',
        'email',
        'especialidad_cod',
        'password',
        'status'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->username;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
    public function fullname()
    {
        return $this->firstname .' '.$this->middlename.', '.$this->primary_lastname.' '.$this->second_lastname;
    }

    /**
     * Muestra el nombre de usuario corto
     * 
     * @return string
     */
    public function shortname()
    {
        return $this->firstname .' '.$this->primary_lastname;
    }

    /**
     * Buscar role por ID
     * 
     * @return role
     */
    public function getRoleById($id)
    {
        return $this->role->where('id', $id)->first()->guard_name;
    }

    /**
     * Buscar role por Slug
     * 
     * @return role
     */
    public function getRoleIdBySlug($role)
    {
        return $this->role->where('name', $role)->first();
        // return $this->role->where('role_slug', $role)->where('sede_id', $this->sede_id)->first()->id;
    }

    /**
     * Verifica si el usuario es administrador
     * 
     * @return boolean
     */
  /*  public function isAdmin()
    {
        return $this->hasRole() === "administrador";
    }

    /**
     * Buscar role del usuario logueado
     * 
     * @return role
     */
   public function hasRoles()
    {
        return $this->role->where('id', $this->role_id)->first()->guard_name;
    }

    /**
     * Verifica los permisos del usuario logueado
     * 
     * @return boolean
     */
    public function checkPermissions($permission) 
    {
        $permissions = $this->getPermissions();
        return in_array($permission, $permissions); // return true or false
    }

    /**
     * Consigue todos los permisos del usuario logueado
     * 
     * @return array
     */
    protected function getPermissions()
    {
        // Load permissions for user login
        $permissions = $this->role->where('id', $this->role_id)->get()->load('permissions');
        $permissions_collet = [];
        foreach($permissions as $key => $permission)
        {
            $permission_slug = array_pluck($permission['permissions'], 'permission_slug');
            foreach($permission_slug as $index => $per)
            {
                array_push($permissions_collet, $per);
            }
        }
        return $permissions_collet;
    }

    /**
     * Relationships Has One
     * @return model relation
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

     /**
     * Relationship One to Many
     * @return model relation
     */
    public function phones()
    {
        return $this->hasMany('App\Models\Phone', 'user_id');
    }

    public function especialidad() {
        return $this->belongsTo('App\Models\Especialidad');
    }

    public function proyecto()
    {
        return $this->hasMany('App\Models\Proyecto', 'user_id');
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto', 'sc_user_proyecto', 'user_id', 'proyecto_id')
        ->withPivot('id','sede_id','periodo_id','total_hours','status')->withTimestamps();
    }

    public function actividades()
    {
        return $this->hasMany('App\Models\Actividad', 'user_id');
    }

    public function grupos()
    {
        return $this->hasMany('App\Models\Grupo', 'user_id');
    }

    public function prestadores()
    {
        return $this->hasMany('App\Models\Prestador', 'user_id');
    }

    public function comunidades()
    {
        return $this->hasMany('App\Models\Comunidad', 'user_id');
    }

    public function periodos() {
        return $this->belongsToMany('App\Periodo', 'sc_user_proyecto', 'user_id', 'periodo_id')
        ->withPivot('id','sede_id','proyecto_id','total_hours','status')->withTimestamps();
    }

    public function sede() {
        return $this->belongsTo('App\Models\InstitutoUser', 'id');
    }
}
