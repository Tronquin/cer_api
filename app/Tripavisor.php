<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Tripavisor extends Model
{
    use FieldTranslationTrait;

    protected $table = 'tripavisor';

    protected $fillable = [
        'autor',
        'status'
    ];

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