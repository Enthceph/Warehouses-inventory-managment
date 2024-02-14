<?php

namespace App\Services;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    public function get()
    {
        return User::where('company_id', Auth::user()->company->id)->with(['role', 'company'])->get();
    }

    public function store(StoreEmployeeRequest $request)
    {
        return User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'company_id' => Auth::user()->company->id
        ]);
    }

    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        return $employee->update($request->all());
    }

}
