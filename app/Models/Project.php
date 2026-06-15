<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\RecyclesIds;

class Project extends Model
{
    use RecyclesIds;

    protected $fillable = ['name', 'start_date', 'end_date', 'status'];
    public function tasks() {return $this->hasMany(Task::class);}
}
