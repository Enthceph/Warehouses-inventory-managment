<?php
namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

class ProductCategoryService
{

    /** 
     * @return ProductCategory[]
     */
    public function get()
    {
        return ProductCategory::where('company_id', Auth::user()->company_id)->get(['id', 'name']);
    }

    public function show(ProductCategory $productCategory) : ProductCategory
    {
        return $productCategory;
    }
    public function store(StoreProductCategoryRequest $request)
    {
        return ProductCategory::create([
            'name' => $request['name'],
            'company_id' => Auth::user()->company_id
        ]);
    }
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        return $productCategory->update($request->validated());
    }
    public function destroy(ProductCategory $productCategory)
    {
        return $productCategory->delete($productCategory);
    }
}