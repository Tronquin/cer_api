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
    
    public function extras()
    {
        return $this->belongsTo(Extra::class,'extra_id','extra_id');

    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }


}