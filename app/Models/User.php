<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'role',
        'email',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function manager()
    {
        return $this->hasOne(Manager::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
