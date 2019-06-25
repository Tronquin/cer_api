<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'gender',
        'pais',
        'phone',
        'ciudad',
        'direccion',
        'postal_code',
        'birthday',
        'country_id'
    ];

    protected $hidden = ['password'];

    /**
     * session activa de este usuario
     */
    public function session()
    {
        return $this->hasOne(Session::class, 'session_id');
    }

    /**
    * roles de este usuario
    */
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'role_user', 'user_id', 'role_id');
    }

    /**
    * Comprueba los permisos del usuario
    * @param string|array $roles
    */
    public function authorizeRoles($roles){
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        } 
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
    * Verifica los roles del usuario
    * @param array $roles
    */
    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    
    /**
    * Comprueba un rol del usuario
    * @param string $role
    */
    public function hasRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Pais
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * is admin?
     */
    /* public function isAdmin()
    {
        return strtolower($this->rol->name) === 'admin';
    } */

    /**
     * is client?
     */
    /* public function isClient()
    {
        return strtolower($this->rol->name) === 'user';
    } */
}
