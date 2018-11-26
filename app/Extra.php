<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras';

    protected $fillable = [
        'extra_id',
        'type',
        'ubicacion_id',
        'nombre',
        'nombre_es',
        'nombre_en',
        'nombre_fr',
        'nombre_zh',
        'nombre_ru',
        'nombre_po',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_zh',
        'descripcion_ru',
        'descripcion_po',
        'coste',
        'base_imponible',
        'iva_tipo',
        'manera_cobro',
        'servicio_gestion',
        'destacado',
        'activo',
    ];

    
    public function extras()
    {
        return $this->hasMany(Extra::class);
    }

    /**
     * Extra::find(1)->ubicacion;
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion()
    {
        return $this->belongsTo(Location::class, 'ubicacion_id');
    }

}