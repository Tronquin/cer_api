<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';

    protected $fillable = [
        'experiencia_id',
        'ubicacion_id',
        'type',
        'parent_id',
        'nombre',
        'color',
        'galeria_id',
        'incidencia_porcentaje',
        'predeterminada',
        'limpieza_cada_dias',
        'sabanas_cada_dias',
        'upgrade_extra_id',
    ];

    /**
     * Session asociada al usuario
     */
    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'experiences_extras', 'experiencie_id', 'extra_id');
    }
}
