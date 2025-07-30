<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'priority',
        'completed',
        'due_date',
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];
}
