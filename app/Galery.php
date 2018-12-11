<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'code',
        'parent_id'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'galleries_id');
    }

    // Relacion para obtener las galerias padres creadas a traves del admin
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // Relacion para obtener las galerias hijos creadas a traves del admin
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
