<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name_arabic',
        'name_english',
        'description',
        'image',
        'sort_order',
        'class_room_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
