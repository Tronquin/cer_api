<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationKey extends Model
{
    protected $table = 'reservation_keys';

    protected $fillable = [
        'reserva_id',
        'keys_delivered',
        'keys_received',
    ];

}
