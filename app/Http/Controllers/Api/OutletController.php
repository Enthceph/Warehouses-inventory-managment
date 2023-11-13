<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOutletRequest;
use App\Services\OutletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    public function index(OutletService $service)
    {
        return $service->get();
    }

    public function store(CreateOutletRequest $request, OutletService $service)
    {
        $service->store($request);
    }

    public function update(Request $request, int $id, OutletService $service)
    {
        $outlet = $service->show($id);

        if (!$outlet) return response('Cant find outlet', 404);

        $service->update($request, $outlet);

        return response('Outlet changed successfully');
    }

    public function show($id, OutletService $service)
    {
        $userId = Auth::id();
        $orgId = Auth::user()->organisation->id;

        $outlet = $service->show($id);

        if (!$userId || $outlet->organisation_id !== $orgId) {
            return response(['message' => 'Unauthorized'], 401);
        }

        if (!$outlet) {
            return response(['message' => 'Not Found'], 404);
        }

        return $outlet;
    }

    public function destroy(Request $request, int $id, OutletService $service)
    {
        return $service->delete($id);
    }
}
