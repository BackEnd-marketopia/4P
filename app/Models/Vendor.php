<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable =
    [
        'name',
        'logo',
        'cover',
        'description',
        'whatsapp',
        'facebook',
        'instagram',
        'address',
        'google_map_link',
        'citys_id',
        'category_id',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
