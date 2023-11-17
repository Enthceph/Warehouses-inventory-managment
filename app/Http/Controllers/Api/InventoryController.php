<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function index(InventoryService $service)
    {
        return $service->get();
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

    public function show($id, InventoryService $service)
    {
        return $service->show($id);
    }

    public function update(Request $request, $id, InventoryService $service)
    {
        return $service->update($id);
    }

    public function destroy(Request $request, int $id)
    {
        //
    }
}
