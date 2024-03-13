<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetInventoryRequest;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Models\Outlet;
use App\Services\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $service
    ) {
    }
    /**
     * @return Inventory[]
     */
    public function index(GetInventoryRequest $request)
    {
        $this->authorize('view', Inventory::class);

        return $this->service->get($request);
    }

    public function getAnalyticsFilterInfo() : array
    {
        $this->authorize('view', Inventory::class);

        return $this->service->getAnalyticsFilterInfo();
    }

    public function store(StoreInventoryRequest $request) : Response
    {
        $this->authorize('store', Inventory::class);

        $this->service->store($request);

        return response(['message' => 'Inventory created']);
    }
    /**
     * @return Inventory[]
     */
    public function show(Warehouse $warehouse)
    {
        $this->authorize('view', Inventory::class);

        return $this->service->show($warehouse);
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory) : Response
    {
        $this->authorize('update', $inventory);

        $this->service->update($request, $inventory);

        return response(['message' => 'Inventory updated']);
    }

    public function destroy(Inventory $inventory) : Response
    {
        $this->authorize('delete', $inventory);

        $this->service->destroy($inventory);

        return response(['message' => 'Inventory deleted']);
    }
}
