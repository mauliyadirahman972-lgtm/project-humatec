<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'status'];
    public function tasks() {return $this->hasMany(Task::class);}
}
