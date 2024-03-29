<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use FieldTranslationTrait;

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
     * Extras asociados a la experiencia
     */
    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'experiences_extras', 'experience_id', 'extra_id')
            ->withPivot('is_published');
    }

    public function extras_experiences_not_included()
    {
        return $this->belongsToMany(Extra::class, 'experiences_extras_not_included', 'experience_id', 'extra_id')->withTimestamps();
    }
    /**
     * Apartamentos asociados a la experiencia
     */
    public function apartamentos()
    {
        return $this->belongsToMany(Apartment::class, 'experiences_apartments', 'experience_id', 'apartment_id');
    }

    /**
     * Galeria de la experiencia
     */
    public function galeria()
    {
        return $this->belongsTo(Galery::class, 'galeria_id', 'galeria_id');
    }

    /*public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function ubicacion()
    {

        return $this->belongsTo('App\Ubicacion');

    }

    */

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['nombre', 'title', 'description'];
    }
}
