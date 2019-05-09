<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class SpaInfo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'spa_info';

    protected $fillable = [
        'photo',
        'link_tour',
        'location_id'
    ];

    /**
     * Todas las secciones del SPA
     */
    public function spaSections()
    {
        return $this->hasMany(SpaSection::class, 'spa_info_id');
    }

    /**
     * Todas las secciones del SPA
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
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
            'name',
            'title',
            'subtitle',
            'alt_image'
        ];
    }
}
