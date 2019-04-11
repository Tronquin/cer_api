<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use FieldTranslationTrait;

    protected $table = 'documents';

    protected $fillable = [
    ];

    public function Locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function extraOutstandings()
    {
        return $this->belongsTo(ExtraOustanding::class, 'extra_outstandings_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return [''];
    }
}
