<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $table = 'advertising';

    protected $fillable = [
        'number',
        'description'
    ];

    /**
     * Items de esta publicidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisingItems()
    {
        return $this->hasMany(AdvertisingItem::class, 'advertising_id');
    }
}
