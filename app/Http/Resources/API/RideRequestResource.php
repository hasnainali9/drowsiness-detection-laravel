<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideRequestResource extends JsonResource
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
            'source'=>$this->source,
            'source_lat'=>(float)$this->source_lat,
            'source_long'=>(float)$this->source_long,
            'destination'=>$this->destination,
            'destination_lat'=>(float)$this->destination_lat,
            'destination_long'=>(float)$this->destination_long,
            'ride_drownies'=>RideDrowniesResource::collection($this->rideDrownies()->get()),
            'status'=>$this->status,
        ];
    }
}
