<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class FrequentQuestion extends Model
{
    use FieldTranslationTrait;

    protected $table = 'frequent_questions';

    protected $fillable = [
        'active',
        'order',
    ];

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['title','description'];
    }
}
