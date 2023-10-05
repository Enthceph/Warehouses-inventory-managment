<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $org = Inventory::where('owner_id', Auth::id())->first();

        return $org->outlets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateOutletRequest $request)
    {

        $orgId = Auth::user()->organisation->id;

        Outlet::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'organisation_id' => $orgId,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $orgId = Auth::user()->organisation->id;
        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response(['message' => 'Not Found'], 404);
        }

        if (!$userId || $outlet->organisation_id !== $orgId) {
            return response(['message' => 'Unauthorized'], 401);
        }


        return $outlet;
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
    public function destroy($id)
    {
        //
    }
}
