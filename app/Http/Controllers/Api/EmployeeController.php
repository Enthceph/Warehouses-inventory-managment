<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $service
    )
    {
    }

    public function index()
    {
        $this->authorize('view', User::class);

        return $this->service->get();
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create', User::class);

        $employee = $this->service->store($request);

        if (!$employee) {
            return response(['message' => 'Unable to create employee'], 500);
        }

        return $employee;
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'Unable to find employee'], 404);
        }

        $this->authorize('show', $user);

        return $user;
    }

    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'Unable to find employee'], 404);
        }

        $this->authorize('update', $user);

        $updatedEmployee = $this->service->update($request, $user);

        if (!$updatedEmployee) {
            return response(['message' => 'Unable to update employee'], 500);
        }

        return $updatedEmployee;
    }

    public function destroy(Request $request, int $id)
    {
        $employee = User::find($id);

        if (!$employee) {
            return response(['message' => 'Unable to find employee'], 404);
        }

        $this->authorize('delete', $employee);

        $employee->delete();

        return response(['message' => 'Employee was deleted']);
    }
}
