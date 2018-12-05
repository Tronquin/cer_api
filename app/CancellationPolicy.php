<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancellationPolicy extends Model
{
    protected $table = 'cancellation_policys';

    protected $fillable = [
        'politica_cancelacion_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre',
        'nombre_cliente',
        'incidencia_porcentaje',
        'activo',
    ];



}