<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Http\Resources\OutletCollection;
use App\Http\Resources\OutletResource;
use App\Models\Outlet;
use App\Services\OutletService;

class OutletController extends Controller
{
    public function __construct(
        protected OutletService $service
    ) {
    }

    public function index(): OutletCollection
    {
        $this->authorize('view', Outlet::class);

        return new OutletCollection($this->service->get());
    }

    public function show(Outlet $outlet): OutletResource
    {
        $this->authorize('view', $outlet);

        return new OutletResource($outlet);
    }

    public function store(StoreOutletRequest $request)
    {
        $this->authorize('store', Outlet::class);

        $this->service->store($request);
    }

    public function update(UpdateOutletRequest $request, Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        $this->service->update($request, $outlet);
    }

    public function destroy(Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        $outlet->delete();
    }
}
