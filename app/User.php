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
    ];

    /**
     * session activa de este usuario
     */
    public function session()
    {
        return $this->hasOne(Session::class, 'session_id');
    }
}
