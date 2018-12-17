<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldTranslation extends Model
{
    protected $table = 'field_translations';

    protected $fillable = [
        'content_id',
        'content_type',
        'language_id',
        'translation',
        'field'
    ];

    /**
     * Idioma
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
