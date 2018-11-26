<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'location_id',
        'type',
        'nombre',
        'minimo_noches',
        'direccion',
        'plantas',
        'total_apartamentos',
        'coordenadas',
        'total_ascensores',
        'parking',
        'restaurante',
        'terraza_comunitaria',
        'recepcion',
        'guarda_maletas',
        'knock',
        'ip_ubicacion',
        'iva_reservas',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_po',
    ];

    public function experiencias()
    {
            return $this->hasMany(Experience::class, 'ubicacion_id');
    }

    /**
     * Ubicacion::find($ubicacion_id)->extras;
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extras()
    {
            return $this->hasMany(Extra::class, 'ubicacion_id');
    }
}