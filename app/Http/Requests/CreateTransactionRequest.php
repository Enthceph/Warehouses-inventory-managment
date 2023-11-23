<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
            'outlet_id' => 'required|exists:outlets,id',
            'type' => 'required|exists:transaction_categories,category',
            'amount' => 'required|numeric',
            'inventory_id' => 'required|exists:Inventory,id',
            'product_name' => 'required|exists:Inventory,product_name',

            'description' => 'string|nullable',
            'date' => 'date',
        ];
    }
}
