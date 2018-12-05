<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'tarifa_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre',
        'incidencia_fijo',
        'incidencia_porcentaje',
        'extra_id',
        'activo',
        'orden_calculo',
    ];



}