<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuth2Client extends Model
{
    protected $table = 'oauth2_clients';

    protected $fillable = [
        'description',
        'token',
        'type',
        'device_type_id'
    ];

    /**
     * Tipo de dispositivo al que corresponde este cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }
}
