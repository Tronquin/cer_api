<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oauth2Token extends Model
{
    protected $table = 'oauth2_tokens';

    protected $fillable = [
        'oauth2_client_id',
        'token',
        'expired_at'
    ];

    protected $dates = ['expired_at'];

    /**
     * Cliente asociado al token
     */
    public function oauth2Client()
    {
        return $this->belongsTo(OAuth2Client::class, 'oauth2_client_id');
    }
}
