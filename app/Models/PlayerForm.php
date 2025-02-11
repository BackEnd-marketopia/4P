<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerForm extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'age',
        'name_of_old_club',
        'name_of_current_club',
        'job_of_parent',
        'long_life_desises',
        'injuries',
        'images',
        'city_name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
