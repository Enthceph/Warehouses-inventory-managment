<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;

class ProductCategoriesController extends Controller
{
    public function __construct(
        protected ProductCategoryService $service
    ) {
    }


    public function index(): ProductCategoryCollection
    {
        $this->authorize('view', ProductCategory::class);

        return new ProductCategoryCollection($this->service->get());
    }

    public function show(ProductCategory $productCategory): ProductCategoryResource
    {
        $this->authorize('view', $productCategory);

        return new ProductCategoryResource($this->service->show($productCategory));
    }
    public function store(StoreProductCategoryRequest $request)
    {
        $this->authorize('store', ProductCategory::class);

        $this->service->store($request);
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $this->authorize('update', $productCategory);

        $this->service->update($request, $productCategory);
    }

    public function destroy(ProductCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);

        $this->service->destroy($productCategory);
    }
}
