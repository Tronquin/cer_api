<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuth2Client extends Model
{
    protected $table = 'oauth2_clients';

    protected $fillable = [
        'description',
        'client_id',
        'secret_id',
        'oauth2_client_type_id'
    ];

    /**
     * Tipo de cliente
     */
    protected function oauth2ClientType()
    {
        return $this->belongsTo(OAuth2ClientType::class, 'oauth2_client_type_id');
    }

    /**
     * Todos los tokens de este cliente
     */
    public function tokens()
    {
        return $this->hasMany(Oauth2Token::class, 'oauth2_client_id');
    }
}
