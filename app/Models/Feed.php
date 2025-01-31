<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable =
    [
        'title',
        'short_description',
        'description',
        'image',
        'url',
    ];
}
