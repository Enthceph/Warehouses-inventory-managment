<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Inventory;
use App\Models\Warehouse;
use App\Models\Outlet;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * @return Inventory[]
     */
    public function index()
    {
        $companyId = Auth::user()->company_id;

        return Inventory::with(['product.category', 'warehouse'])
            ->whereHas('warehouse', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->get();
    }

    public function getAnalyticsFilterInfo() : array
    {
        $companyId = Auth::user()->company_id;

        $inventories = Inventory::with(['product', 'warehouse'])
            ->whereHas('warehouse', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->get()->toArray();

        $unitPrices = array_column($inventories, 'unit_price');
        $minUnitPrice = min($unitPrices);
        $maxUnitPrice = max($unitPrices);

        $totalValues = array_column($inventories, 'total_value');
        $minTotalValue = min($totalValues);
        $maxTotalValue = max($totalValues);

        $createdDates = array_column($inventories, 'created_at');
        $minCreatedAt = min($createdDates);
        $maxCreatedAt = max($createdDates);

        $quantities = array_column($inventories, 'quantity');
        $minQuantity = min($quantities);
        $maxQuantity = max($quantities);

        $productNames = array_values(
            array_unique(
                array_column(
                    array_column($inventories, 'product'), 'name')
            )
        );

        $productAdditionalInfos = array_unique(
            array_column(
                array_column($inventories, 'product'),
                'additional_info'
            )
        );
        $productAdditionalInfos = array_values(
            array_filter($productAdditionalInfos, function ($value) {
                return $value !== null;
            })
        );

        $warehouseNames = array_values(
            array_unique(
                array_column(
                    array_column($inventories, 'warehouse'),
                    'name'
                )
            )
        );

        $outletsNames = Outlet::pluck('name');

        return [
            'products' => $productNames,
            'additional_info' => $productAdditionalInfos,
            'warehouses' => $warehouseNames,
            'outlets' => $outletsNames,

            'unit_price' => [
                'min' => intval($minUnitPrice),
                'max' => intval($maxUnitPrice)
            ],
            'total_value' => [
                'min' => intval($minTotalValue),
                'max' => intval($maxTotalValue)
            ],
            'created_at' => [
                'from' => $minCreatedAt,
                'to' => $maxCreatedAt
            ],
            'quantity' => [
                'min' => intval($minQuantity),
                'max' => intval($maxQuantity)
            ],
        ];
    }

    public function store(StoreInventoryRequest $request) : Response
    {
        Inventory::create($request->validated());

        return response(['message' => 'Inventory created']);
    }
    /**
     * @return Inventory[]
     */
    public function show(Warehouse $warehouse)
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
