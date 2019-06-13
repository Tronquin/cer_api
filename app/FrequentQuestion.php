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

    public function locations()
    {
        return $this->belongsToMany(
            Location::class, 
            'frequent_question_location', 
            'frequent_question_id', 
            'location_id'
        );
    }

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
