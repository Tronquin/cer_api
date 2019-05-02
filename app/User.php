<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements JWTSubject
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id'              => $this->id,
            'timestamp'   => $this->created_at->toIso8601String()
        ];
    }
}
