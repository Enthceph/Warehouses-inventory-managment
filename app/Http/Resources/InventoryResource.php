<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'unitPrice' => $this->unit_price,
            'totalValue' => $this->total_value,
            'createdAt' => $this->created_at,
            'expiresAt' => $this->expires_at,
            'warehouse' => $this->warehouse,
            'product' => $this->product,
        ];
    }
}
