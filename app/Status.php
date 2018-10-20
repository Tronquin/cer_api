<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
        'code',
    ];

    /**
     * Status asociado a ReservationPersistence
     */
    public function ReservationPersistence()
    {
        return $this->belongsTo(ReservationPersistence::class, 'status_id');
    }

    /**
     * Status asociado a GuestPersistence
     */
    public function GuestPersistence()
    {
        return $this->belongsTo(ReservationGuestPersistence::class, 'status_id');
    }

    /**
     * Status asociado a ServicePersistence
     */
    public function ServicePersistence()
    {
        return $this->belongsTo(ReservationServicePersistence::class, 'status_id');
    }

}
