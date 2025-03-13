<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'name',
        'image',
        'start_date',
        'end_date',
        'url',
        'viewed',
        'clicked',
        'city_id',
    ];
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
