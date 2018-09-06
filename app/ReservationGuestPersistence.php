<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationGuestPersistence extends Model
{
    protected $table = 'reservation_guest_persistence';

    protected $fillable = [
        'reserva_id',
        'guest_id',
        'type_id',
        'nombre',
        'apellido1',
        'apellido2',
        'nacionalidad',
        'sexo',
        'fecha_nacimiento',
        'identificacion',
        'tipo_documento',
        'pais',
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

}
