<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTaskContent extends Model
{
    protected $fillable = ['task_id', 'user_id', 'content', 'type'];
}
