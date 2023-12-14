<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'image'=>$this->image,
            'analytics'=>[
                'no_of_rides'=>$this->rideRequestList()->get()->count(),
                'total_sos'=>$this->sosList()->get()->count(),
                'no_of_drownies'=>0,
                'average_detection_rate'=>0
            ],
            'pending_ride'=>new RideRequestResource($this->pendingRideRequests()->first())
        ];

    }
}
