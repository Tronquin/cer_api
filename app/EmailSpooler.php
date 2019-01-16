<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSpooler extends Model
{
    /** Status */
    const STATUS_PENDING = 0;
    const STATUS_SENT = 1;

    protected $table = 'email_spooler';
}
