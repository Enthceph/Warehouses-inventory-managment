<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\GetWarehouseInventoryRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseService $service
    )
    {
    }

    public function index()
    {
        $this->authorize('view', Warehouse::class);

        return $this->service->get();
    }

    public function store(CreateWarehouseRequest $request)
    {
        $this->authorize('create', Warehouse::class);

        $warehouse = $this->service->store($request);

        if (!$warehouse) {
            return response(['message' => 'Unable to create warehouse'], 500);
        }

        return $warehouse;
    }

    public function update(UpdateWarehouseRequest $request, int $id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Couldn\'t find requested warehouse'], 404);
        }

        $this->authorize('update', $warehouse);

        $updatedWarehouse = $this->service->update($request, $warehouse);

        if (!$updatedWarehouse) {
            return response(['message' => 'Unable to update warehouse'], 500);
        }

        return response(['message' => 'Updated warehouse successfully']);
    }

    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Couldn\'t find requested warehouse'], 404);
        }

        $this->authorize('show', $warehouse);

        return $warehouse;
    }

    public function getWarehouseInventory(GetWarehouseInventoryRequest $request)
    {
        $this->authorize('view', Warehouse::class);

        return $this->service->getInventory($request);
    }

    public function destroy(Request $request, int $id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Couldn\'t find requested warehouse'], 404);
        }

        $this->authorize('delete', $warehouse);

        $warehouse->delete();

        return response(['message' => 'Warehouses was deleted']);
    }
}
