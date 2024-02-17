<?php

namespace App\Services;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryService
{
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

    }

    public function update(Request $request, $id)
    {

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

    public function get()
    {

    }

    public function destroy(Request $request, int $id)
    {
        //
    }
}
