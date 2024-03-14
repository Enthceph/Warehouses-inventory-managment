<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    //    public function __construct(
//        protected ProductCategoryService $service
//    )
//    {
//    }
    // TODO сделать сервис
    /**
     * @return Product[]
     */
    public function index()
    {
        $this->authorize('view', Product::class);

        return Product::where('company_id', Auth::user()->company_id)->with(['company', 'category'])->get();
    }

    public function store(StoreProductRequest $request) : Product
    {
        $this->authorize('store', Product::class);

        return Product::create([
            'name' => $request['name'],
            'additional_info' => $request['additional_info'],
            'category_id' => $request['category_id'],
            'company_id' => Auth::user()->company_id
        ]);
    }

    public function show(Product $product) : Product
    {
        $this->authorize('view', $product);

        return $product;
    }


    public function update(UpdateProductRequest $request, Product $product) : Response
    {
        $this->authorize('update', $product);

        $product->update($request);

        return response(['message' => 'Product changed successfully']);
    }

    public function destroy(Product $product) : Response
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response(['message' => 'Product was deleted']);
    }
}
