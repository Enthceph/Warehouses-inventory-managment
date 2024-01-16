<?php

namespace App\Services;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function update(Request $request, $id)
    {
        $authRole = Auth::user()->role->name;

        $user = User::findOrFail($id);

        if ($authRole == 'Admin') {
            $user->update($request);
            return response(['message' => 'Employee updated successfully']);
        }

        if ($authRole == 'Owner') {
            if (!$request->has('role_id')) {
                return response(['message' => 'You can only change employee\'s role'], 401);
            }

            if ($request->role_id == 1 || $request->role_id == 2) {
                return response(['message' => 'You are unauthorized to set a role to owner or admin'], 401);
            }

            $user->update([
                'role_id' => $request['role_id']
            ]);

            return response(['message' => 'Employee updated successfully']);
        }


        return response(['message' => 'You are unauthorized to change employees'], 401);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) return response(['message' => 'Cant find employee'], 404);

        $user->delete();

        return response(['message' => 'Employee was deleted']);
    }
}
