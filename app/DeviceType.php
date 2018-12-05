<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = 'device_types';

    protected $fillable = ['code'];

    /**
     * Todos los clientes con este tipo de dispositivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oAuth2Clients()
    {
        return $this->hasMany(OAuth2Client::class, 'device_type_id');
    }

    /**
     * Todas las claves de traduccion asociadas a este tipo de dispositivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keyTranslations()
    {
        return $this->hasMany(KeyTranslation::class, 'device_type_id');
    }
}
