<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable =
    [
        'title',
        'description',
        'start_date',
        'end_date',
        'vendor_id',
        'image',
        'viwe_count',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function discountChecks()
    {
        return $this->hasMany(DiscountCheck::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'discount_checks', 'discount_id', 'user_id')
            ->withPivot('id');
    }
}
