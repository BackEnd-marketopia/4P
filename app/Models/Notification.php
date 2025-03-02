<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Africa/Cairo');
    }
}
