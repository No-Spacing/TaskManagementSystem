<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use DateTimeInterface;


class Ticket extends Model
{
    
    protected $fillable = [
        'title',
        'description',
        'assigned_department_id',
        'created_by',
        'submitted_by',
        'status_id'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'assigned_department_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
