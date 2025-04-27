<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionLog extends Model
{
    // protected $table = 'sessions';
    protected $fillable = [
        'user_id',
        'event',
        'ip_address',
        'user_agent'
    ];
}
