<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Cocina extends Model
{
    use FieldTranslationTrait;

    protected $table = 'cocinas';

    protected $fillable = [
        'cocina_id',
        'tipologia_id',
        'nevera',
        'vitro',
        'mocroondas',
        'horno',
        'maquina_cafe',
        'hervidor',
        'lavadora',
        'secadora',
        'plancha',
        'lavavajillas',
        'mesa_comedor',
    ];

    public function tipologia()
    {
        return $this->belongsTo(Typology::class,'tipologia_id','tipologia_id');
    }


    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['nombre'];
    }
}
