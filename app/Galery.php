<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'galeria_id',
        'type',
        'parent_id',
        'nombre',
        'nombre_en',
        'nombre_fr',
        'nombre_po',
        'tipologia_id',
    ];

    /**
     * Session asociada al usuario
     */
    public function experiencies()
    {
        return $this->belongsTo(Experience::class, 'user_id');
    }
}
