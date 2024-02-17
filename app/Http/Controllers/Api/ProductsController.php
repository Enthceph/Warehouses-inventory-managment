<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
//    public function __construct(
//        protected ProductCategoryService $service
//    )
//    {
//    }

    public function index()
    {
        $this->authorize('view', Product::class);

        return Product::where('company_id', Auth::user()->company_id)->with(['company', 'category'])->get();
    }

    public function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request['name'],
            'additional_info' => $request['additional_info'],
            'category_id' => $request['category_id'],
            'company_id' => Auth::user()->company_id
        ]);

        if (!$product) {
            return response(['message' => 'Couldn\'t create product'], 500);
        }

        return $product;
    }

    public function show(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response(['message' => 'Couldn\'t find requested product'], 404);
        }

        $this->authorize('view', $product);

        return $product;
    }


    public function update(UpdateProductRequest $request, int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response(['message' => 'Couldn\'t find requested product'], 404);
        }

        $this->authorize('update', $product);

        $updatedProductCategory = $product->update($request->all());

        if (!$updatedProductCategory) {
            return response(['message' => 'Unable to update product'], 500);
        }

        return response(['message' => 'Product changed successfully']);
    }

    public function destroy(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response(['message' => 'Couldn\'t find requested product'], 404);
        }

        $this->authorize('delete', $product);

        $product->delete();

        return response(['message' => 'Product was deleted']);
    }
}
