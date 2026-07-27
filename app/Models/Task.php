<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Models\UserTaskContent;

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task_contents')
                    ->select('users.id', 'users.name') // only select specific columns from users table
                    ->withPivot(['content', 'file', 'status_id'])           // only include specific pivot columns
                    ->withTimestamps();
    }

    public function userTaskContents()
    {
        return $this->hasMany(UserTaskContent::class);
    }

    public function status () : HasOne {
        return $this->hasOne(Status::class, 'id', 'status_id')
                    ->select(['id', 'name']);
    }
}
