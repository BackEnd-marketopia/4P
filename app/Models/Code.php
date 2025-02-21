<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($code) {
            if ($code->end_date && $code->end_date < now()) {
                return false;
            }
        });

        static::retrieved(function ($code) {
            if ($code->end_date && $code->end_date < now()) {
                $code->delete();
            }
        });
    }
}
