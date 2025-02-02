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
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
