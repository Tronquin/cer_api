<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class ERPImage extends Model
{
    use FieldTranslationTrait;

    protected $table = 'erp_images';

    protected $fillable = [
        'erp_photo_id',
        'url'
    ];

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['alt_image'];
    }
}
