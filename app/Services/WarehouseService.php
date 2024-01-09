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
            return $item->only(['id', 'name', 'location', 'contact_info']);
        });

        return $warehouses;
    }

    public function store(CreateWarehouseRequest $request)
    {
        $company_id = Auth::user()->company->id;

        return Warehouse::create([
            'name' => $request->name,
            'location' => $request->location,
            'contact_info' => $request->contact_info,
            'company_id' => $company_id,
        ]);
    }

    public function update(UpdateWarehouseRequest $request, $id)
    {
        $warehouse = $this->show($id);

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

        return $warehouse;
    }

    public function destroy(int $id)
    {
        $warehouse = $this->show($id);

        $warehouse->delete();

        return response(['message' => 'Warehouse was deleted']);
    }
}
