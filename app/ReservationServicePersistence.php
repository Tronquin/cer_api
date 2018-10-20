<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationServicePersistence extends Model
{
    protected $table = 'reservation_service_persistences';

    protected $fillable = [
        'reserva_id',
        'extra_id',
        'cantidad',
        'status_id',
    ];

    /**
     * Status
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'status_id');
    }
}
