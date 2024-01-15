<?php

namespace App\Services;

use App\Http\Requests\CreateOutletRequest;
use App\Http\Requests\CreateWarehouseRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutletService
{
    public function get()
    {
        $outlets = Auth::user()->company->outlets;
        $outlets->transform(function ($item) {
            return $item->only(['id', 'name', 'address', 'contact_info', 'warehouse_id', 'created_at']);
        });

        return $outlets;
    }

    public function store(CreateOutletRequest $request, WarehouseService $warehouseService)
    {
        return DB::transaction(function () use ($request, $warehouseService) {
            $warehouse_name = $request->has('warehouse_name')
                ? $request->warehouse_name
                : $request->name . '\'s warehouse';

            $warehouse = $warehouseService->store(new CreateWarehouseRequest([
                'name' => $warehouse_name
            ]));

            return Outlet::create([
                'name' => $request->name,
                'address' => $request->address,
                'contact_info' => $request->contact_info,
                'company_id' => Auth::user()->company->id,
                'warehouse_id' => $warehouse['id']
            ]);
        });
    }

    public function show($id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $outlet = Outlet::find($id);

        if (!$userId || $outlet->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        if (!$outlet) {
            return response(['message' => 'Not Found'], 404);
        }

        return $outlet;
    }

    public function update(Request $request, int $id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $outlet = Outlet::find($id);

        if (!$userId || $outlet->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        if (!$outlet) {
            return response(['message' => 'Not Found'], 404);
        }

        $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'warehouse_id' => $request->warehouse_id
        ]);

        return response(['message' => 'Outlet changed successfully']);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $companyId = Auth::user()->company->id;
        $outlet = Outlet::find($id);

        if (!$userId || $outlet->company_id !== $companyId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        if (!$outlet) {
            return response(['message' => 'Not Found'], 404);
        }

        $outlet->delete();

        return response(['message' => 'Outlet was deleted']);
    }
}
