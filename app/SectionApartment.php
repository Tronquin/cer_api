<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SectionApartment extends Model
{
    use FieldTranslationTrait;

    protected $table = 'section_apartments';

    protected $fillable = [
        'photo',
        'order',
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
}
