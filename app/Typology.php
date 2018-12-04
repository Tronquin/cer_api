<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    protected $table = 'tipologies';

    protected $fillable = [
        'tipologia_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre_manual',
        'status',
        'max',
        'min',
        'incidencia_porcentaje',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_po',
    ];

    /**
     * Session asociada al usuario
     */
    public function experiencies()
    {
        return $this->belongsTo(Experience::class, 'user_id');
    }
}
