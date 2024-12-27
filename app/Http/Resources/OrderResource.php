<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'order_date' => $this->order_date,
            'zip_code' => $this->zip_code,
            'province' => $this->province,
            'city' => $this->city,
            'street' => $this->street,
            'total' => $this->total,
            'status' => $this->status,
            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'customer' => new UserResource($this->whenLoaded('customer')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
