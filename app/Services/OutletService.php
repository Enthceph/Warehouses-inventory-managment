<?php

namespace App\Services;

use App\Http\Requests\CreateOutletRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletService
{
    public function get()
    {
        return Auth::user()->organisation->outlets;
    }

    public function store(CreateOutletRequest $request)
    {
        $orgId = Auth::user()->organisation->id;

        Outlet::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact_info' => $request->contact_info,
            'organisation_id' => $orgId,
        ]);
    }

    public function show($id)
    {
        return $outlet = Outlet::find($id);
    }

    public function update(Request $request, Outlet $outlet)
    {
        $outlet->update([
            'name' => $request->name,
            'address' => $request->name,
            'contact_info' => $request->name,
        ]);
    }

    public function delete($id)
    {
        $outlet = Outlet::find($id);

        if (!$outlet) return response(['message' => 'Cant find outlet'], 404);

        $outlet->delete();

        return response(['message' => 'Outlet was deleted']);
    }
}
