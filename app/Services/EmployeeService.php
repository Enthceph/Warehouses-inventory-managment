<?php

namespace App\Services;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    public function get()
    {
        return Employee::where('organisation_id', Auth::user()->organisation->id)
            ->with('user')
            ->get()
            ->filter(function ($employee) {
                return $employee->user != null;
            })
            ->map(function ($employee) {
                return [
                    'id' => $employee->user->id,
                    'first_name' => $employee->user->first_name,
                    'last_name' => $employee->user->last_name,
                    'email' => $employee->user->email,
                    'role' => $employee->user->role->role,
                ];
            });
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

    public function show($id)
    {
        return User::find($id);
    }

    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        if (!$user) response(['message' => 'User not found'], 404);

        $user->update($request->all());

        return response(['message' => 'User updated successfully'], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) return response(['message' => 'Cant find employee'], 404);

        $user->delete();

        return response(['message' => 'Employee was deleted']);
    }
}
