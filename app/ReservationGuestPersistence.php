<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationGuestPersistence extends Model
{
    protected $table = 'reservation_guest_persistence';

    protected $fillable = [
        'reservation_persistence_id',
        'type_id',
        'nombre',
        'apellido',
        'nacionalidad',
        'identificacion',
        'tipo',
        'email',
        'telefono',
        'img',
    ];

    /**
     * Tipo de huesped
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * Reserva a la que pertenece
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservationPersistence()
    {
        return $this->belongsTo(ReservationPersistence::class, 'reservation_persistence_id');
    }

}
