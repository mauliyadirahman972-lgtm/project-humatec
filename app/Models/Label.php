<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\RecyclesIds;

class Label extends Model
{
    use RecyclesIds;

    protected $fillable = ['name', 'color'];
    public function tasks() {return $this->hasMany(Task::class);}
}
