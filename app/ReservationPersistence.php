<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationPersistence extends Model
{
    protected $table = 'reservation_persistence';

    protected $fillable = [
        'reserva_id',
        'adults',
        'kids',
        'tipologia_id',
        'plan_id',
        'experience_id',
        'services',
    ];

}
