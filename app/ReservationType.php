<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    protected $table = 'reservation_types';

    protected $fillable = [
        'code',
    ];

    /**
     * Define el tipo de huesped
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservationGuestPersistence()
    {
        return $this->hasMany(ReservationGuestPersistence::class, 'reservation_type_id');
    }

}
