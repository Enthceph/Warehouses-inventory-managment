<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use App\Models\Outlet;
use App\Services\OutletService;
use Illuminate\Http\Response;

class OutletController extends Controller
{
    public function __construct(
        protected OutletService $service
    ) {
    }
    /**
     * @return Outlet[]
     */
    public function index()
    {
        $this->authorize('view', Outlet::class);

        return $this->service->get();
    }

    public function store(CreateOutletRequest $request) : Outlet
    {
        $this->authorize('create', Outlet::class);

        return $this->service->store($request->validated());
    }

    public function update(UpdateOutletRequest $request, Outlet $outlet) : Response
    {
        $this->authorize('update', $outlet);

        $this->service->update($request->validated(), $outlet);

        return response(['message' => 'Outlet changed successfully']);
    }

    public function show(Outlet $outlet) : Outlet
    {
        $this->authorize('view', $outlet);

        return $outlet;
    }

    public function destroy(Outlet $outlet) : Response
    {
        $this->authorize('delete', $outlet);

        $outlet->delete();

        return response(['message' => 'Outlet was deleted']);
    }
}
