<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideDrownies extends Model
{
    use HasFactory;
    protected $fillable=[
        'ride_request_id',
        'place',
        'place_lat',
        'place_long',
        'image',
        'video'
    ];



    /**
     * Define an inverse one-to-many relationship with RideRequest model.
     */
    public function rideRequest()
    {
        return $this->belongsTo(RideRequest::class, 'ride_request_id');
    }


}
