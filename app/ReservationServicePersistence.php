<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationServicePersistence extends Model
{
    protected $table = 'reservation_service_persistence';

    protected $fillable = [
        'reserva_id',
        'extra_id',
        'cantidad',
    ];

}
