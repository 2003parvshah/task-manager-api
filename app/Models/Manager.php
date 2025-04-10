<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'profile_image',
        'department', // example fields
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'manager_id');
    }
}
