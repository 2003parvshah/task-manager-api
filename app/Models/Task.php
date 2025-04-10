<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'manager_id',
        'employee_id',
        'task_details',
        'rating',
        'review',
        'status',
        'predicted_due_date',
        'completed_at',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function statusChanges()
    {
        return $this->hasMany(StatusChange::class);
    }
}
