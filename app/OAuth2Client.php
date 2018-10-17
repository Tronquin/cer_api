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
    ];

}
