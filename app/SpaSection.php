<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SpaSection extends Model
{
    use FieldTranslationTrait;

    protected $table = 'spa_sections';

    protected $fillable = [
        'spa_info_id',
        'name',
        'ico',
        'photo'
    ];

    /**
     * Informacion del SPA
     */
    public function spaInfo()
    {
        return $this->belongsTo(SpaInfo::class, 'spa_info_id');
    }

    /**
     * Todos los iconos de la seccion
     */
    public function icons()
    {
        return $this->hasMany(Icon::class, 'spa_section_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description'];
    }
    
}
