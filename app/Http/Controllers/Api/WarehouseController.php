<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use App\Services\WarehouseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseService $service
    ) {
    }
    /**
     * @return Warehouse[]
     */
    public function index() : array
    {
        $this->authorize('view', Warehouse::class);

        return $this->service->get();
    }

    public function store(StoreWarehouseRequest $request) : Warehouse
    {
        $this->authorize('create', Warehouse::class);

        return $this->service->store($request);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse) : Response
    {
        $this->authorize('update', $warehouse);

        $this->service->update($request, $warehouse);

        return response(['message' => 'Updated warehouse successfully']);
    }

    public function show(Warehouse $warehouse) : Warehouse
    {
        $this->authorize('show', $warehouse);

        return $warehouse;
    }

    public function destroy(Request $request, Warehouse $warehouse)
    {
        $this->authorize('delete', $warehouse);

        $warehouse->delete();

        return response(['message' => 'Warehouses was deleted']);
    }
}
