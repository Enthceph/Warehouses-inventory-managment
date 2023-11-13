<?php

namespace App\Services;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($request) {
            $role_id = Role::getRoleId($request->role);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'role_id' => $role_id,
                'password' => Hash::make($request->password),
            ]);

            $orgId = Auth::user()->organisation->id;

            Employee::create([
                'organisation_id' => $orgId,
                'employee_id' => $user->id,
            ]);
        });
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {

//        TODO сервис, по идее, не должен возвращать response
        $user = User::find($id);

        if (!$user) return response('Cant find employee', 404);

        $role = Role::getRoleByName($request->role);

        if ($role === 'Owner') return response('Cant set role to owner', 401);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $role,
        ]);

        return response('Employee changed successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) return response('Cant find employee', 404);

        $user->delete();

        return response('Employee was deleted');
    }
}
