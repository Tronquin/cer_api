<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SectionApartment extends Model
{
    use FieldTranslationTrait;

    protected $table = 'section_apartments';

    protected $fillable = [
        'location_id',
        'photo',
        'order',
        'show_web'
    ];

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['name', 'alt_image'];
    }

    /**
     * extras asociados a esta section
     */
    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'section_apartment_extras', 'section_apartment_id', 'extra_id');
    }
}
