<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    /**
     * Define a one-to-many relationship with the Sos model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sosList()
    {
        return $this->hasMany(Sos::class);
    }


    public function rideRequestList()
    {
        return $this->hasMany(RideRequest::class);
    }

    public function pendingRideRequests()
    {
        return $this->hasMany(RideRequest::class)
            ->where(function (Builder $query) {
                // Get ride requests with status 'pending' or 'started'
                $query->where('status', 'pending')
                    ->orWhere('status', 'started');
            });
    }
}
