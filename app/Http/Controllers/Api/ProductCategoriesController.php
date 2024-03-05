<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $this->authorize('view', ProductCategory::class);

        return ProductCategory::where('company_id', Auth::user()->company_id)->get(['id', 'name']);
    }

    public function store(CreateProductCategoryRequest $request)
    {
        return ProductCategory::create([
            'name' => $request['name'],
            'company_id' => Auth::user()->company_id
        ]);
    }

    public function show(ProductCategory $productCategory)
    {
        $this->authorize('view', $productCategory);

        return $productCategory;
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $this->authorize('update', $productCategory);

        $productCategory->update($request->validated());

        return response(['message' => 'Product category changed successfully']);
    }

    public function destroy(ProductCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);

        $productCategory->delete();

        return response(['message' => 'Product category was deleted']);
    }
}
