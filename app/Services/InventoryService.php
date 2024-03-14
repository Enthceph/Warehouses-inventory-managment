<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Outlet;
use App\Models\Warehouse;
use App\Http\Requests\GetInventoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;

class InventoryService
{
    public function get(GetInventoryRequest $request)
    {
        return Inventory::query()
            ->with(['warehouse', 'product.category'])
            ->whereHas('warehouse', function ($query) use ($request) {
                $query->where('company_id', Auth::user()->company_id);
            })
            ->when($request->has('products'), function ($query) use ($request) {
                $query->whereHas('product', function ($query) use ($request) {
                    $products = explode(',', $request->products);
                    $query->where('name', $products);
                });
            })
            ->when($request->has('warehouses'), function ($query) use ($request) {
                $query->whereHas('warehouse', function ($query) use ($request) {
                    $warehouses = explode(',', $request->warehouses);
                    $query->where('name', $warehouses);
                });
            })
            ->when($request->has('outlets'), function ($query) use ($request) {
                $outlets = explode(',', $request->outlets);

                $outletsWarehouseIds = Outlet::whereIn('name', $outlets)->pluck('warehouse_id');

                $query->whereHas('warehouse', function ($query) use ($request, $outletsWarehouseIds) {
                    $query->whereIn('warehouse_id', $outletsWarehouseIds);
                });
            })
            ->when($request->has('additional_info'), function ($query) use ($request) {
                $query->withWhereHas('product', function ($query) use ($request) {
                    $additional_infos = explode(',', $request->additional_info);
                    $query->where('additional_info', $additional_infos);
                });
            })
            // quantity
            ->when($request->has('quantity_min'), function ($query) use ($request) {
                $query->where('quantity', '>=', $request->quantity_min);
            })
            ->when($request->has('quantity_max'), function ($query) use ($request) {
                $query->where('quantity', '<=', $request->quantity_max);
            })
            // unit_price
            ->when($request->has('unit_price_min'), function ($query) use ($request) {
                $query->where('unit_price', '>=', $request->unit_price_min);
            })
            ->when($request->has('unit_price_max'), function ($query) use ($request) {
                $query->where('unit_price', '<=', $request->unit_price_max);
            })
            // total_value
            ->when($request->has('total_value_min'), function ($query) use ($request) {
                $query->where('total_value', '>=', $request->total_value_min);
            })
            ->when($request->has('total_value_max'), function ($query) use ($request) {
                $query->where('total_value', '<=', $request->total_value_max);
            })
            // created_at
            ->when($request->has('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', $request->created_at);
            })
            ->when($request->has('created_at_from'), function ($query) use ($request) {
                $query->where('created_at', '>=', $request->created_at_from);
            })
            ->when($request->has('created_at_to'), function ($query) use ($request) {
                $query->where('created_at', '<=', $request->created_at_to);
            })
            // expires_at
            ->when($request->has('expires_at'), function ($query) use ($request) {
                $query->whereDate('expires_at', '=', $request->expires_at);
            })
            ->when($request->has('expires_at_from'), function ($query) use ($request) {
                $query->where('expires_at', '>=', $request->expires_at_from);
            })
            ->when($request->has('expires_at_to'), function ($query) use ($request) {
                $query->where('expires_at', '<=', $request->expires_at_to);
            })
            ->get();
    }

    public function getAnalyticsFilterInfo()
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
    public function store(StoreInventoryRequest $request)
    {
        return Inventory::create($request->validated());
    }
    public function show(Warehouse $warehouse)
    {
        return $warehouse->inventories;
    }
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        return $inventory->update($request->validated());
    }
    public function destroy(Inventory $inventory)
    {
        return $inventory->delete();
    }

}