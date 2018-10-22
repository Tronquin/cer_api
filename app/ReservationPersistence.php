<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationPersistence extends Model
{
    /** Estatus de la reserva */
    const STATUS_CHECKOUT = 'checkout';

    protected $table = 'reservation_persistences';

    protected $fillable = [
        'reserva_id',
        'adults',
        'kids',
        'tipologia_id',
        'apartamento_id',
        'plan_id',
        'experience_id',
        'status-id',
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
