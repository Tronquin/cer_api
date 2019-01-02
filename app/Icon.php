<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use FieldTranslationTrait;

    protected $table = 'icons';

    protected $fillable = [
        'spa_section_id',
        'ico'
    ];

    /**
     * Informacion de la seccion
     */
    public function sectionInfo()
    {
        return $this->belongsTo(SpaSection::class, 'spa_section_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['name'];
    }

}
