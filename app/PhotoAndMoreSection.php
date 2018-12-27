<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class PhotoAndMoreSection extends Model
{
    use FieldTranslationTrait;

    protected $table = 'photos_and_more_sections';

    protected $fillable = [];

    /**
     * Informacion de "fotos y mas"
     */
    public function photoAndMore()
    {
        return $this->belongsTo(PhotoAndMore::class, 'photo_and_more_id');
    }

    /**
     * Galeria
     */
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
        return ['name', 'title_video', 'title_gallery', 'description_gallery'];
    }

    /**
     * Seccion de apartamento
     */
    public function sectionApartment()
    {
        return $this->belongsTo(SectionApartment::class, 'section_apartment_id');
    }
}
