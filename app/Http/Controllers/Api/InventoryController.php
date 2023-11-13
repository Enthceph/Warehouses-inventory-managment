<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Warehouse;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $org = Auth::user()->organisation;

        $warehouses = $org->warehouses;

        $inventories = $warehouses->map(function ($warehouse) {
            return $warehouse->inventories;
        });

        return $inventories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
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

        Debugbar::log($warehouse->inventories);

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

    public function destroy(Request $request, int $id)
    {
        //
    }
}
