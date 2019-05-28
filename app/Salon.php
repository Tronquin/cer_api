<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use FieldTranslationTrait;

    protected $table = 'salones';

    protected $fillable = [
        'salon_id',
        'tipologia_id',
        'tv',
        'sofas',
        'sofacama',
        'comedor',
        'sillas',
        'telefono',
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
