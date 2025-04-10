<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StatusChange extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'task_id',
        'old_status',
        'new_status',
        'changed_at',
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

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
