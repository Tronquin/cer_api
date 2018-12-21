<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SpaInfo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'spa_info';

    protected $fillable = [
        'photo'
    ];

    /**
     * Todas las secciones del SPA
     */
    public function spaSections()
    {
        return $this->hasMany(SpaSection::class, 'spa_info_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return [
            'description',
            'title',
            'subtitle'
        ];
    }
}
