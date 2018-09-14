<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Tinker\TinkerServiceProvider;

class ReservationPaymentPersistence extends Model
{
    protected $table = 'reservation_payment_persistence';

    protected $fillable = [
        'reserva_id',
        'msg',
        'numOpBco',
        'code',
        'numRefTP',
        'bIN',
        'numOpCO',
        'red',
        'codAut',
        'aRC',
        'tipoLectura',
        'moneda',
        'tipoOp',
        'cVM',
        'txtBanco',
        'tarjeta',
        'taxFree',
        'ticket',
        'tipoTarjeta',
        'terminal',
        'importe',
        'fechaContable',
        'pais',
        'idSesion',
        'lBL',
        'comercio',
        'aID',
        'txtMarca',
        'titular',
        'emisor',
    ];

}
