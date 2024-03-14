<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {
    }

    /**
     * @return Product[]
     */
    public function index()
    {
        $this->authorize('view', Product::class);
        return $this->service->get();
    }
    public function show(Product $product) : Product
    {
        $this->authorize('view', $product);
        return $this->service->show($product);
    }

    public function store(StoreProductRequest $request) : Response
    {
        $this->authorize('store', Product::class);

        $this->service->store($request);

        return response(['message' => 'Product created successfully']);
    }

    public function update(UpdateProductRequest $request, Product $product) : Response
    {
        $this->authorize('update', $product);

        $this->service->update($request, $product);

        return response(['message' => 'Product changed successfully']);
    }

    public function destroy(Product $product) : Response
    {
        $this->authorize('delete', $product);

        $this->service->destroy($product);

        return response(['message' => 'Product was deleted']);
    }
}
