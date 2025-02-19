<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'image',
        'type',
        'to',
        'user_id',
        'data',
        'is_read',
    ];
}
