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
     * Indica si el cliente es maquina
     */
    public function isMachine()
    {
        return $this->deviceType->code === 'machine';
    }

    /**
     * Indica si el cliente es web
     */
    public function isWeb()
    {
        return $this->deviceType->code === 'web';
    }

    /**
     * Indica si el cliente es app
     */
    public function isApp()
    {
        return $this->deviceType->code === 'app';
    }

    /**
     * Tipo de dispositivo al que corresponde este cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }
}
