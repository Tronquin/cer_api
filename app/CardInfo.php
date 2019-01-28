<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class CardInfo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'card_info';

    protected $fillable = [
        'front_image',
        'active',
        'order',
        'url'
    ];

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['name','description', 'alt_image'];
    }
}
