<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTodo extends Model
{
    protected $table = 'tag_todo';

    protected $fillable = [
        'tag_id',
        'todo_id',
    ];
}
