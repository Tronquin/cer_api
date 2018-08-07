<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisingItem extends Model
{
    protected $table = 'advertising_items';

    protected $fillable = [
        'advertising_id',
        'params'
    ];

    /**
     * Publicidad a la que pertenece este item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'advertising_id');
    }
}
