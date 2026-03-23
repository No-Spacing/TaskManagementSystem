<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'steps',
        'created_by',
        'status_id'
    ];

    public function status () : HasOne {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function contents()
    {
        return $this->hasMany(UserTaskContent::class);
    }


    public function users () {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
