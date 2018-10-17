<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';

    protected $fillable = [
        'user_id',
        'token',
        'remember_me',
        'expired_at',
    ];

    protected $dates = ['expired_at'];
    
    /**
     * Session asociada al usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
