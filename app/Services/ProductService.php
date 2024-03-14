<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ProductService
{    /**
     * @return Product[]
     */
    public function get()
    {
        return Product::where('company_id', Auth::user()->company_id)->with(['company', 'category'])->get();

    }
    public function show(Product $product) : Product
    {
        return $product;

    }
    public function store(StoreProductRequest $request)
    {
        return Product::create([
            'name' => $request['name'],
            'additional_info' => $request['additional_info'],
            'category_id' => $request['category_id'],
            'company_id' => Auth::user()->company_id
        ]);
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        return $product->update($request->validated());
    }
    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
