<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'name',
        'type',
        'url',
        'sort_order',
        'lesson_id',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
