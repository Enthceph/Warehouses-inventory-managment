<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Models\Outlet;
use App\Services\OutletService;

class OutletController extends Controller
{
    public function __construct(
        protected OutletService $service
    )
    {
    }

    public function index()
    {
        $this->authorize('view', Outlet::class);

        return $this->service->get();
    }

    public function store(CreateOutletRequest $request)
    {
        $this->authorize('create', Outlet::class);

        $outlet = $this->service->store($request);

        if (!$outlet) {
            return response(['message' => 'Unable to create outlet'], 500);
        }

        return $outlet;
    }

    public function update(UpdateOutletRequest $request, int $id)
    {
        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response(['message' => 'Couldn\'t find requested outlet'], 404);
        }

        $this->authorize('update', $outlet);

        $updatedOutlet = $this->service->update($request, $outlet);

        if (!$updatedOutlet) {
            return response(['message' => 'Unable to update outlet'], 500);
        }

        return response(['message' => 'Outlet changed successfully']);
    }

    public function show($id)
    {
        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response(['message' => 'Couldn\'t find requested outlet'], 404);
        }

        $this->authorize('view', $outlet);

        return $outlet;
    }

    public function destroy(int $id)
    {
        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response(['message' => 'Couldn\'t find requested outlet'], 404);
        }

        $this->authorize('delete', $outlet);

        $outlet->delete();

        return response(['message' => 'Outlet was deleted']);
    }
}
