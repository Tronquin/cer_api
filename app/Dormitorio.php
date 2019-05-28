<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Dormitorio extends Model
{
    use FieldTranslationTrait;

    protected $table = 'dormitorios';

    protected $fillable = [
        'dormitorio_id',
        'tipologia_id',
        'cama',
        'camas_cantidad',
        'tv',
        'armario',
        'balcon',
        'telefono'
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
