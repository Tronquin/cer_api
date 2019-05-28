<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class Typology extends Model
{
    use FieldTranslationTrait;

    protected $table = 'typologies';

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
        'front_image',
    ];

    /**
     * Caracteristicas que contiene esta tipologia
     */
    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'typology_characteristic', 'typology_id', 'characteristic_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    public function apartamentos()
    {
        return $this->hasMany(Apartment::class,'tipologia_id','tipologia_id');
    }

    public function cocinas()
    {
        return $this->hasMany(Cocina::class,'tipologia_id','tipologia_id');
    }

    public function dormitorios()
    {
        return $this->hasMany(Dormitorio::class,'tipologia_id','tipologia_id');
    }

    public function lavabos()
    {
        return $this->hasMany(Lavabo::class,'tipologia_id','tipologia_id');
    }

    public function salones()
    {
        return $this->hasMany(Salon::class,'tipologia_id','tipologia_id');
    }

    public function terrazas()
    {
        return $this->hasMany(Terraza::class,'tipologia_id','tipologia_id');
    }

    public function ubicacion(){
        return $this->belongsTo(Location::class,'tipologia_id','tipologia_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['nombre','description'];
    }

}
