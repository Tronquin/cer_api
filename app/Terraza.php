<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Terraza extends Model
{
    use FieldTranslationTrait;

    protected $table = 'terrazas';

    protected $fillable = [
        'terraza_id',
        'tipologia_id',
        'mesa',
        'sillas',
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
