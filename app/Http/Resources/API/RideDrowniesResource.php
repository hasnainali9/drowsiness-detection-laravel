<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideDrowniesResource extends JsonResource
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
            'address'=>$this->place,
            'lat'=>(float)$this->place_lat,
            'long'=>(float)$this->place_long,
            'image'=>$this->image,
            'video'=>$this->video
        ];
    }
}
