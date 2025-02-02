<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{

    public function toArray( $request)
    {
      return [
        'id' => $this->id,
        'order_id' => $this->order_id,
        'product_id' => $this->product_id,
        'quantity' => $this->quantity,
        'total' => $this->total,
        'box_id' => $this->box_id,
        'order' => new OrderResource($this->whenLoaded('order')),
        'product' => new ProductResource($this->whenLoaded('product')),
        'box' => new BoxResource($this->whenLoaded('box')),
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at
      ];
    }
}
