<?php

namespace App\Services;

use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class WarehouseService
{
    public function store(CreateWarehouseRequest $request)
    {
        $company_id = Auth::user()->company->id;

        return Warehouse::create([
            'name' => $request['name'],
            'location' => $request['location'],
            'contact_info' => $request['contact_info'],
            'company_id' => $company_id,
        ]);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        return $warehouse->update([
            'name' => $request->name,
            'location' => $request->location,
            'contact_info' => $request->contact_info,
        ]);
    }

    public function get()
    {
        $company = Auth::user()->company;

        $warehouses = $company->warehouses;

        $warehousesWithInventories = $warehouses->map(function ($warehouse) {
            $warehouse['inventory'] = $warehouse->inventory;

            return $warehouse;
        });

        return $warehousesWithInventories;
    }

    public function getInventory($request)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $warehouse = Warehouse::find($request['id']);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $warehouse->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $inventory = $warehouse->inventory;

        return $inventory;
    }
}
