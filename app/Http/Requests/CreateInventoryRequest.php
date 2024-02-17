<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use Illuminate\Foundation\Http\FormRequest;

class CreateInventoryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Inventory::class);
    }

    public function rules()
    {
        return [
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total_value' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ];
    }
}

