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
        'rol_id',
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
    * rol de este usuario
    */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    /**
     * Pais
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
