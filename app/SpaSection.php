<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaSection extends Model
{
    protected $table = 'spa_sections';

    protected $fillable = [
        'spa_info_id',
        'name',
        'description',
        'icon',
        'photo'
    ];

    /**
     * Informacion del SPA
     */
    public function spaInfo()
    {
        return $this->belongsTo(SpaInfo::class, 'spa_info_id');
    }
}
