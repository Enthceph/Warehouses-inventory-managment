<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Product::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'additional_info' => 'string|nullable',
            'category_id' => 'required|exists:product_categories,id',
        ];
    }
}
