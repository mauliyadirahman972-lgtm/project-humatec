<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\RecyclesIds;

class Task extends Model
{
    use RecyclesIds;

    protected $fillable = ['project_id', 'label_id', 'title', 'description', 'status', 'due_date'];

public function project() { return $this->belongsTo(Project::class); }
public function label() { return $this->belongsTo(Label::class); }
public function employees() { return $this->belongsToMany(Employee::class, 'task_assignments'); }
}
