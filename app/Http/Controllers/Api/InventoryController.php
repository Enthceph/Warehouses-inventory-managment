<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\Warehouse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * @return Inventory[]
     */
    public function index() : array
    {
        $companyId = Auth::user()->company_id;

        return Inventory::with(['product.category', 'warehouse'])
            ->whereHas('warehouse', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->get();
    }

    public function store(CreateInventoryRequest $request) : Response
    {
        Inventory::create($request->validated());

        return response(['message' => 'Inventory created']);
    }
    /**
     * @return Inventory[]
     */
    public function show(Warehouse $warehouse) : array
    {
        $this->authorize('view', Inventory::class);

        return $warehouse->inventories;
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory) : Response
    {
        $this->authorize('update', $inventory);

        $inventory->update($request->validated());

        return response(['message' => 'Inventory updated']);
    }

    public function destroy(Inventory $inventory) : Response
    {
        $this->authorize('delete', $inventory);

        $inventory->delete();

        return response(['message' => 'Inventory deleted']);
    }
}
