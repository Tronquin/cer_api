<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class PhotoAndMore extends Model
{
    use FieldTranslationTrait;

    protected $table = 'photos_and_more';

    protected $fillable = [];

    /**
     * Ubicacion a la que pertenece
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * Secciones
     */
    public function sections()
    {
        return $this->hasMany(PhotoAndMoreSection::class, 'photo_and_more_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['title', 'subtitle'];
    }
}
