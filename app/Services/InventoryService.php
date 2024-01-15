<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryService
{
    public function get()
    {
        $company = Auth::user()->company;

        $warehouses = $company->warehouses;

        $inventories = $warehouses->map(function ($warehouse) {
            $warehouse['inventory'] = $warehouse->inventory;
            return $warehouse;
        });

        return $inventories;
    }

    public function store(CreateInventoryRequest $request)
    {

//        $orgId = Auth::user()->organisation->id;
//
//        Outlet::create([
//            'name' => $request->name,
//            'address' => $request->address,
//            'contact_info' => $request->contact_info,
//            'organisation_id' => $orgId,
//        ]);
    }

    public function show($id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        return $warehouse->inventories;
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);

        if (!$inventory) return response(['message' => 'Cant find inventory'], 404);

        $inventory->update([
            'name' => $request->name,
            'address' => $request->name,
            'contact_info' => $request->name,
        ]);

        return response(['message' => 'Inventory changed successfully']);
    }

    public function getInventory($id)
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

        $inventory = $warehouse->inventory;

        return $inventory;
    }

    public function destroy(Request $request, int $id)
    {
        //
    }
}
