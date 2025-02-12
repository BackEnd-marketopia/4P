<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name_arabic',
        'name_english',
        'logo',
        'whatsapp',
        'facebook',
        'instagram',
        'address',
        'status',
        'user_id',
    ];

    public function educationDepartments()
    {
        return $this->belongsToMany(EducationDepartment::class);
    }
}
