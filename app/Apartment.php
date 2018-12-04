<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aparment extends Model
{
    protected $table = 'aparments';

    protected $fillable = [
        'apartamento_id',
        'type',
        'parent_id',
        'nombre',
        'tipologia_id',
        'status',
        'ubicacion_id',
        'planta',
        'puerta',
        'acceso_id',
        'altura',
        'area',
        'orientacion',
        'galeria_id',
        'pass_emergencia',
    ];

    /**
     * Session asociada al usuario
     */
    public function experiencies()
    {
        return $this->belongsTo(Experience::class, 'user_id');
    }
}
