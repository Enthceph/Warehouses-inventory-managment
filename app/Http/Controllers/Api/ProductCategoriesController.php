<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ProductCategoriesController extends Controller
{
    /**
     * @return ProductCategory[]
     */
    public function index()
    {
        $this->authorize('view', ProductCategory::class);

        return ProductCategory::where('company_id', Auth::user()->company_id)->get(['id', 'name']);
    }

    public function store(StoreProductCategoryRequest $request) : ProductCategory
    {
        $this->authorize('store', ProductCategory::class);
        return ProductCategory::create([
            'name' => $request['name'],
            'company_id' => Auth::user()->company_id
        ]);
    }

    public function show(ProductCategory $productCategory) : ProductCategory
    {
        $this->authorize('view', $productCategory);

        return $productCategory;
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory) : Response
    {
        $this->authorize('update', $productCategory);

        $productCategory->update($request);

        return response(['message' => 'Product category changed successfully']);
    }

    public function destroy(ProductCategory $productCategory) : Response
    {
        $this->authorize('delete', $productCategory);

        $productCategory->delete();

        return response(['message' => 'Product category was deleted']);
    }
}
