<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'trnx_id',
        'user_id',
        'amount',
        'txn_response_code',
        'message',
        'pending',
        'success',
        'type',
        'source_data_sub_type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
