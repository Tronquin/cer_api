<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = [
        'ip',
        'oauth2_client_id',
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
        return $this->belongsTo(OAuth2Client::class, 'oauth2_client_id');
    }
}
