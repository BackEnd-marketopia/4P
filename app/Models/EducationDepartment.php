<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationDepartment extends Model
{
    protected $fillable = [
        'name_arabic',
        'name_english',
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }
}
