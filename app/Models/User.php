<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Department;
use App\Models\Task;
use App\Models\UserTaskContent;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'steps',
        'department_id',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
    
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task_contents')
                    ->withPivot(['content', 'file', 'status_id'])
                    ->withTimestamps();
    }

    public function userTaskContents()
    {
        return $this->hasMany(UserTaskContent::class);
    }

    
    public function getCountOfPendingTaskAttribute()
    {
        return $this->tasks()
                    ->wherePivot('status_id', 1) // assuming 1 = pending
                    ->count();
    }


    public function status () : HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
