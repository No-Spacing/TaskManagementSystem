<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquired extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'organization',
        'company',
        'address',
        'city',
        'country',
        'message',
    ];
}
