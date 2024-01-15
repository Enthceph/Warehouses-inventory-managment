<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Services\OutletService;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index(OutletService $service)
    {
        return $service->get();
    }

    public function store(CreateOutletRequest $request, OutletService $service, WarehouseService $warehouseService)
    {
        $service->store($request, $warehouseService);
    }

    public function update(UpdateOutletRequest $request, int $id, OutletService $service)
    {
        return $service->update($request, $id);
    }

    public function show($id, OutletService $service)
    {
        return $service->show($id);
    }

    public function destroy(Request $request, int $id, OutletService $service)
    {
        return $service->destroy($id);
    }
}
