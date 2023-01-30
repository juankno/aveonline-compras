<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity_products' => $this->quantity_products,
            'customer' => $this->whenLoaded('customer'),
            'products' => $this->whenLoaded('products'),
        ];
    }
}
