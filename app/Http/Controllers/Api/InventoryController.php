<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetInventoryRequest;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Http\Resources\InventoryCollection;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Services\InventoryService;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $service
    ) {
    }

    public function index(GetInventoryRequest $request): InventoryCollection
    {
        $this->authorize('view', Inventory::class);

        $inventories =  $this->service->get($request);

        return new InventoryCollection($inventories->paginate(
            $request->perPage,
            ['*'],
            'page',
            $request->page
        ));
    }

    public function show(Warehouse $warehouse): InventoryResource
    {
        $this->authorize('view', Inventory::class);

        return new InventoryResource($this->service->show($warehouse));
    }

    public function getAnalyticsFilterInfo(): array
    {
        $this->authorize('view', Inventory::class);

        return $this->service->getAnalyticsFilterInfo();
    }

    public function store(StoreInventoryRequest $request)
    {
        $this->authorize('store', Inventory::class);

        $this->service->store($request);
    }

    public function update(Inventory $inventory, UpdateInventoryRequest $request)
    {
        $this->authorize('update', $inventory);

        $this->service->update($request, $inventory);
    }

    public function destroy(Inventory $inventory)
    {
        $this->authorize('delete', $inventory);

        $this->service->destroy($inventory);
    }
}
