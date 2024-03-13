<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'products' => 'sometimes|string',
            'warehouses' => 'sometimes|string',
            'outlets' => 'sometimes|string',
            'additional_info' => 'sometimes|string',
            'quantity_min' => 'sometimes|numeric|min:0',
            'quantity_max' => 'sometimes|numeric|min:0',
            'unit_price_min' => 'sometimes|numeric|min:0',
            'unit_price_max' => 'sometimes|numeric|min:0',
            'total_value_min' => 'sometimes|numeric|min:0',
            'total_value_max' => 'sometimes|numeric|min:0',

            'created_at' => 'sometimes|date',
            'created_at_from' => 'sometimes|date',
            'created_at_to' => 'sometimes|date',
            'expires_at' => 'sometimes|date',
            'expires_at_from' => 'sometimes|date',
            'expires_at_to' => 'sometimes|date',
        ];
    }
}
