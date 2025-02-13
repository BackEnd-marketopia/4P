<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = [
        'name_arabic',
        'name_english',
        'image',
        'sort_order',
        'provider_id',
    ];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
