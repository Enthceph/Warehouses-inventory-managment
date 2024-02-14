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
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function get()
    {
        $outlets = Auth::user()->company->outlets;

        $outlets->load('warehouse');

        return $outlets->map(function ($outlet) {
            return [
                'id' => $outlet->id,
                'name' => $outlet->name,
                'address' => $outlet->address,
                'contact_info' => $outlet->contact_info,
                'warehouse' => $outlet->warehouse,
                'created_at' => $outlet->created_at
            ];
        });
    }

    public function store(CreateOutletRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $warehouse_name = $request->has('warehouse_name')
                ? $request->warehouse_name
                : $request->name . '\'s warehouse';

            $warehouse = $this->warehouseService->store(new CreateWarehouseRequest([
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
        return $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'warehouse_id' => $request->warehouse_id
        ]);
    }
}
