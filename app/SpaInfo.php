<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaInfo extends Model
{
    protected $table = 'spa_info';

    protected $fillable = [
        'description',
        'photo'
    ];

    /**
     * Todas las secciones del SPA
     */
    public function spaSections()
    {
        return $this->hasMany(SpaSection::class, 'spa_info_id');
    }
}
