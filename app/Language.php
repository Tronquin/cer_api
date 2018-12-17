<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'flag',
        'status',
        'order'
    ];

    /**
     * Traducciones de este lenguaje
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keyTranslations()
    {
        return $this->belongsToMany(KeyTranslation::class, 'language_translation', 'language_id', 'key_translation_id')
            ->withPivot(['translation'])
            ;
    }

    /**
     * Traducciones para campos dinamicos
     */
    public function fieldTranslations()
    {
        return $this->hasMany(FieldTranslation::class, 'language_id');
    }
}
