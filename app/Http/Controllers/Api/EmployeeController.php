<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $service
    ) {
    }
    /**
     * @return User[]
     */
    public function index()
    {
        $this->authorize('view', User::class);

        return $this->service->get();
    }

    public function store(StoreEmployeeRequest $request) : User
    {
        $this->authorize('store', User::class);

        return $this->service->store($request);
    }

    public function show(User $user) : User
    {
        $this->authorize('show', $user);

        return $user;
    }

    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        $this->authorize('update', $employee);

        $this->service->update($request, $employee);

        return response(['message' => 'Employee updated']);
    }

    public function destroy(User $employee) : Response
    {
        $this->authorize('delete', $employee);

        $employee->delete();

        return response(['message' => 'Employee was deleted']);
    }
}
