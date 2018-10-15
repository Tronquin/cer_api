<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuth2ClientType extends Model
{
    protected $table = 'oauth2_client_types';

    protected $fillable = [
        'code'
    ];

    /**
     * Todos los clientes con este tipo
     */
    protected function oauth2Clients()
    {
        return $this->hasMany(OAuth2Client::class, 'oauth2_client_type_id');
    }
}
