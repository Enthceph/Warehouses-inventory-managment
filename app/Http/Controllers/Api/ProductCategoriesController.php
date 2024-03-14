<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ProductCategoriesController extends Controller
{
    public function __construct(
        protected ProductCategoryService $service
    ) {
    }

    /**
     * @return ProductCategory[]
     */
    public function index()
    {
        $this->authorize('view', ProductCategory::class);

        return $this->service->get();
    }

    public function show(ProductCategory $productCategory) : ProductCategory
    {
        $this->authorize('view', $productCategory);

        return $this->service->show($productCategory);
    }
    public function store(StoreProductCategoryRequest $request) : Response
    {
        $this->authorize('store', ProductCategory::class);

        $this->service->store($request);

        return response(['message' => 'Product created successfully']);
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory) : Response
    {
        $this->authorize('update', $productCategory);

        $this->service->update($request, $productCategory);

        return response(['message' => 'Product category changed successfully']);
    }

    public function destroy(ProductCategory $productCategory) : Response
    {
        $this->authorize('delete', $productCategory);

        $this->service->destroy($productCategory);

        return response(['message' => 'Product category was deleted']);
    }
}
