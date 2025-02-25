<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable =
    [
        'name',
        'email',
        'phone',
        'image',
        'password',
        'city_id',
        'user_type',
        'fcm_token',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    public function playerForm()
    {
        return $this->hasOne(PlayerForm::class);
    }

    public function code()
    {
        return $this->hasOne(Code::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
