<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SpaIcon extends Model
{
    use FieldTranslationTrait;

    protected $table = 'spa_icons';

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
