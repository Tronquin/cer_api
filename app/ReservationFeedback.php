<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationFeedback extends Model
{
    protected $table = 'reservation_feedbacks';

    protected $fillable = [
        'reserva_id',
        'puntuacion',
        'comentario',
    ];

}
