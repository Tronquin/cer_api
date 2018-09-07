<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    protected $fillable = [
        'type',
    ];

    /**
     * Define el tipo de huesped
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservationGuestPersistence()
    {
        return $this->hasMany(ReservationGuestPersistence::class, 'type_id');
    }

}
