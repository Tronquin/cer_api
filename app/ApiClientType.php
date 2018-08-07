<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiClientType extends Model
{
    protected $table = 'api_client_types';

    protected $fillable = [
        'type'
    ];

    /**
     * Historico de versiones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function updateHistory()
    {
        return $this->hasMany(UpdateHistory::class, 'api_client_type_id');
    }

    /**
     * Todos los clientes api con este tipo de cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apiClients()
    {
        return $this->hasMany(ApiClient::class, 'api_client_type_id');
    }
}
