<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['description', 'parent_id'];

    protected $with = ['children','extras'];

    /**
     * Padre
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Hijos
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Extras asociados a este tag
     */
    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'extra_tag', 'tag_id', 'extra_id');
    }
}
