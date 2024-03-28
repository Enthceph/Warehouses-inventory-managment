<?php

namespace App\Services;

use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\StoreWarehouseRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutletService
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function get()
    {
        $outlets = Auth::user()->company->outlets;

        $outlets->load('warehouse');

        return $outlets;
    }

    public function store(StoreOutletRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $warehouse_name = $request->warehouse_name
                ? $request->warehouse_name
                : $request->name . '\'s warehouse';

            $warehouse = $this->warehouseService->store(new StoreWarehouseRequest([
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

    public function update(Request $request, Outlet $outlet)
    {
        return $outlet->update($request->validated());
    }
}
