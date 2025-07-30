<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'priority',
        'solved',
        'solve_at',
    ];
}
