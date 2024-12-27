<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'subscription_type' => $this->subscription_type,
            'status' => $this->status,
            'price' => $this->price,
            'boxItems' => OrderItemResource::collection($this->whenLoaded('boxItems')),
            'customer' => new UserResource($this->whenLoaded('customer')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
