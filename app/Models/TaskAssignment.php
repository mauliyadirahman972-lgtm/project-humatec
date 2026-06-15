<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\RecyclesIds;

class TaskAssignment extends Model
{
    use RecyclesIds;

    protected $fillable = ['task_id', 'employee_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
