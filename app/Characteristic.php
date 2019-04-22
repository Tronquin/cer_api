<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use FieldTranslationTrait;

    protected $table = 'characteristics';

    protected $fillable = ['icon'];

    /**
     * Tipologias que contienen esta caracteristica
     */
    public function typologies()
    {
        return $this->belongsToMany(Typology::class, 'typology_characteristic', 'characteristic_id', 'typology_id');
    }

    /**
     * Fields to translate
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description'];
    }
}
