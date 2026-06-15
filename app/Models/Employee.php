<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\RecyclesIds;

class Employee extends Model
{
    use RecyclesIds;

    protected $fillable = ['name', 'email', 'role'];
    public function tasks() { return $this->belongsToMany(Task::class, 'task_assignments'); }
}
