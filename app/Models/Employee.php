<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'designation',
        'profile_image',
        'team', // example fields
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id');
    }
}
