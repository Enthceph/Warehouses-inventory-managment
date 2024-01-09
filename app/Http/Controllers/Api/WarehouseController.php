<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(WarehouseService $service)
    {
        return $service->get();
    }

    public function store(CreateWarehouseRequest $request, WarehouseService $service)
    {
        return $service->store($request);
    }

    public function update(UpdateWarehouseRequest $request, $id, WarehouseService $service)
    {
        return $service->update($request, $id);
    }

    public function show($id, WarehouseService $service)
    {
        return $service->show($id);
    }

    public function destroy(Request $request, int $id, WarehouseService $service)
    {
        return $service->destroy($id);
    }
}
