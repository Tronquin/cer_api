<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Lavabo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'lavabos';

    protected $fillable = [
        'lavabo_id',
        'tipologia_id',
        'tipo',
        'espejo_aumento',
        'secador',
        'bide',
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
