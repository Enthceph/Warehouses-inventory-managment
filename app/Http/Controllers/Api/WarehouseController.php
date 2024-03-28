<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Http\Resources\WarehouseCollection;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseService $service
    ) {
    }
    /**
     * @return Warehouse[]
     */
    public function index()
    {
        $this->authorize('view', Warehouse::class);

        return new WarehouseCollection($this->service->get());
    }

    public function show(Warehouse $warehouse)
    {
        $this->authorize('show', $warehouse);

        return new WarehouseResource($warehouse);
    }

    public function store(StoreWarehouseRequest $request)
    {
        $this->authorize('store', Warehouse::class);

        $this->service->store($request);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        $this->authorize('update', $warehouse);

        $this->service->update($request, $warehouse);
    }

    public function destroy(Request $request, Warehouse $warehouse)
    {
        $this->authorize('delete', $warehouse);

        $warehouse->delete();
    }
}
