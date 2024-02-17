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
    public function index(): Collection|array
    {
        $companyId = Auth::user()->company_id;

        return Inventory::with(['product.category', 'warehouse'])
            ->whereHas('warehouse', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->get();
    }

    public function store(CreateInventoryRequest $request): Response|Application|ResponseFactory
    {
        $inventory = Inventory::create($request->validated());

        if (!$inventory) {
            return response(['message' => "Couldn't create inventory"], 500);
        }

        return response(['message' => 'Inventory created']);
    }

    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        $this->authorize('view', Inventory::class);

        return $warehouse->inventories;
    }

    public function update(UpdateInventoryRequest $request, $id)
    {
        $inventory = Inventory::find($id);

        if (!$inventory) return response(['message' => 'Cant find inventory'], 404);

        $this->authorize('update', $inventory);

        $inventory->update($request->validated());

        return response(['message' => 'Inventory updated']);
    }

    public function destroy(int $id)
    {
        $inventory = Inventory::find($id);

        if (!$inventory) return response(['message' => 'Cant find inventory'], 404);

        $this->authorize('delete', $inventory);

        $inventory->delete();

        return response(['message' => 'Inventory deleted']);
    }
}
