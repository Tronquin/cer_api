<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = [
        'ip',
        'api_client_id',
        'action',
        'params',
        'response',
        'version'
    ];

    /**
     * Cliente api auditado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiClient()
    {
        return $this->belongsTo(ApiClient::class, 'api_client_id');
    }
}
