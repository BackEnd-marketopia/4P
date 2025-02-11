<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCheck extends Model
{
    protected $fillable = [
        'user_id',
        'discount_id',
    ];

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }


    public function user()
    {
        return $this->hasMany(User::class);
    }
}
