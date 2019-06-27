<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $fillable = [
        'promocion_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'para_web',
        'nombre',
        'incidencia_fijo',
        'incidencia_porcentaje',
        'orden_calculo',
        'activo',
        'publicado_desde',
        'publicado_hasta',
        'alojado_desde',
        'alojado_hasta',
        'min_noches',
        'max_noches',
        'release_desde',
        'release_hasta',
    ];


    public function ubicacion()
    {
        return $this->belongsTo(Location::class,'ubicacion_id','ubicacion_id');
    }
}