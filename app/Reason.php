<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use FieldTranslationTrait;

    protected $table = 'reasons';

    protected $fillable = [
        'reasons_info_id',
        'main_photo',
        'description_photo',
    ];

    /**
     * Whyreserve
     */
    public function reasonsInfo()
    {
        return $this->belongsTo(ReasonsInfo::class, 'reasons_info_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['title','sub_title','description','alt_photo','alt_icon'];
    }
}