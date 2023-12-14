<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'source',
        'source_lat',
        'source_long',
        'destination',
        'destination_lat',
        'destination_long',
        'status'
    ];


    /**
     * Define a many-to-one relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Define a one-to-many relationship with RideDrownies model.
     */
    public function rideDrownies()
    {
        return $this->hasMany(RideDrownies::class, 'ride_request_id');
    }



}
