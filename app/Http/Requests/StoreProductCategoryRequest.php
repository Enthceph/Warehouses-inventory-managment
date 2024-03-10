<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', ProductCategory::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2'
        ];
    }
}
