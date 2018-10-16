<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateHistory extends Model
{
    protected $table = 'update_history';

    protected $fillable = [
        'oauth2_client_type_id',
        'version',
        'date'
    ];

    /**
     * Tipo de cliente api asociado a esta version
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiClientType()
    {
        return $this->belongsTo(OAuth2ClientType::class, 'oauth2_client_type_id');
    }
}
