<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function store(CreateOutletRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param int $warehouse_id
     * @return Response
     */
    public function show($warehouse_id)
    {
        $warehouse = Warehouse::find($warehouse_id);

        Debugbar::log($warehouse->inventories);

        if (!$warehouse) {
            return response(['message' => 'Not Found'], 404);
        }


        return $warehouse->inventories;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $outlet = Outlet::find($id);

        if (!$outlet) return response('Cant find outlet', 404);

        $outlet->update([
            'name' => $request->name,
            'address' => $request->name,
            'contact_info' => $request->name,
        ]);

        return response('Outlet changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, int $id)
    {
        //
    }
}
