<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Auth::user()->organisation->warehouses;


        return $warehouses;
    }

    public function store(CreateWarehouseRequest $request)
    {
        $org_id = Auth::user()->organisation->id;

        Warehouse::create([
            'name' => $request->name,
            'location' => $request->location,
            'contact_info' => $request->contact_info,
            'organisation_id' => $org_id,
        ]);
    }

    public function show($id)
    {
        $userId = Auth::id();
        $orgId = Auth::user()->organisation->id;
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $warehouse->organisation_id !== $orgId) {
            return response(['message' => 'Unauthorized'], 401);
        }


        return $warehouse;
    }

    public function update(UpdateWarehouseRequest $request, $id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) return response('Cant find outlet', 404);

        $warehouse->update([
            'name' => $request->name,
            'address' => $request->name,
            'contact_info' => $request->name,
        ]);

        return response('Outlet changed successfully');
    }

}
