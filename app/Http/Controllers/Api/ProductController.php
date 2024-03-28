<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
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

        return new ProductCollection($this->service->get()) ;
    }
    public function show(Product $product) : Product
    {
        $this->authorize('view', $product);
        return $this->service->show($product);
    }

    public function store(StoreProductRequest $request)
    {
        $this->authorize('store', Product::class);

        $this->service->store($request);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $this->service->update($request, $product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $this->service->destroy($product);
    }
}
