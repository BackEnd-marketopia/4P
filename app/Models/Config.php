<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable =
    [
        'terms_and_conditions',
        'about_us',
        'privacy_policy',
        'android_version',
        'ios_version',
        'android_url',
        'ios_url',
    ];
}
