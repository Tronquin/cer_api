<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'photos';

    protected $fillable = [

    ];

    public function gallery()
    {
        return $this->belongsTo(Galery::class, 'gallery_id');
    }

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
