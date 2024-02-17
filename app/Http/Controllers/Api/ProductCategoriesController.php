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
        $productCategory = ProductCategory::create([
            'name' => $request['name'],
            'company_id' => Auth::user()->company_id
        ]);

        if (!$productCategory) {
            return response(['message' => 'Couldn\'t create product category'], 500);
        }

        return $productCategory;
    }

    public function show($id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response(['message' => 'Couldn\'t find requested product category'], 404);
        }

        $this->authorize('view', $productCategory);

        return $productCategory;
    }

    public function update(UpdateProductCategoryRequest $request, int $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response(['message' => 'Couldn\'t find requested product category'], 404);
        }

        $this->authorize('update', $productCategory);

        $updatedProductCategory = $productCategory->update($request->all());

        if (!$updatedProductCategory) {
            return response(['message' => 'Unable to update product category'], 500);
        }

        return response(['message' => 'Product category changed successfully']);
    }

    public function destroy(int $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response(['message' => 'Couldn\'t find requested product category'], 404);
        }

        $this->authorize('delete', $productCategory);

        $productCategory->delete();

        return response(['message' => 'Product category was deleted']);
    }
}
