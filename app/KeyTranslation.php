<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyTranslation extends Model
{
    protected $table = 'key_translations';

    protected $fillable = [
        'key'
    ];

    /**
     * Traducciones de esta clave
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_translation', 'key_translation_id', 'language_id')
            ->withPivot(['translation'])
            ;
    }
}
