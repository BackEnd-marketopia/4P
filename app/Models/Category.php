<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_arabic',
        'name_english',
        'image',
        'sort_order',
        'is_sport'
    ];
}
