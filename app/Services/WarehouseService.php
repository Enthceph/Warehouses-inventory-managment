<?php

namespace App\Services;

use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class WarehouseService
{
    public function get()
    {
        $warehouses = Auth::user()->company->warehouses;
        $warehouses->transform(function ($item) {
            return $item->only(['id', 'name', 'location', 'contact_info', 'created_at']);
        });

        return $warehouses;
    }

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

    public function update(UpdateWarehouseRequest $request, $id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $warehouse->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $warehouse->update([
            'name' => $request->name,
            'location' => $request->location,
            'contact_info' => $request->contact_info,
        ]);

        return response(['message' => 'Warehouse changed successfully']);
    }

    public function show($id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $warehouse->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $warehouse = $warehouse->only(['id', 'name', 'location', 'contact_info', 'created_at']);

        return $warehouse;
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

    public function destroy(int $id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $warehouse->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $warehouse->delete();

        return response(['message' => 'Warehouses was deleted']);
    }


}
