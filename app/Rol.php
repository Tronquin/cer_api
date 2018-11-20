<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Usuarios del rol
     */
    public function user()
    {
        return $this->hasMany(User::class, 'rol_id');
    }
}
