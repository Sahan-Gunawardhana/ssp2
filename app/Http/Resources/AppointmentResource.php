<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'drop_off_date' => $this->drop_off_date,
            'pick_up_date' => $this->pick_up_date,
            'description' => $this->description,
            'status' => $this->status,
            'customer' => new UserResource($this->whenLoaded('customer')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
