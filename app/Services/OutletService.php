<?php

namespace App\Services;

use App\Http\Requests\CreateOutletRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletService
{
    public function getOutlets()
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
}
