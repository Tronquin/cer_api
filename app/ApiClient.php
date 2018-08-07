<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model
{
    protected $table = 'api_clients';

    protected $fillable = [
        'api_client_type_id',
        'location',
        'ip',
        'token',
        'status',
        'version'
    ];

    /**
     * Tipo de cliente api
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiClientType()
    {
        return $this->belongsTo(ApiClientType::class, 'api_client_type_id');
    }

    /**
     * Todas las auditorias de este cliente api
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audits()
    {
        return $this->hasMany(Audit::class, 'client_api_id');
    }
}
