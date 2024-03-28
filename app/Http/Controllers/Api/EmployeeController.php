<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
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

    public function index(): EmployeeCollection
    {
        $this->authorize('view', User::class);

        return new EmployeeCollection($this->service->get());
    }

    public function show(User $user): EmployeeResource
    {
        $this->authorize('show', $user);

        return new EmployeeResource($user);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('store', User::class);

        $this->service->store($request);
    }

    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        $this->authorize('update', $employee);

        $this->service->update($request, $employee);
    }

    public function destroy(User $employee)
    {
        $this->authorize('delete', $employee);

        $employee->delete();
    }
}
