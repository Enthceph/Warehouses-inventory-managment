<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(EmployeeService $service)
    {
        return $service->get();
    }

    public function store(StoreEmployeeRequest $request, EmployeeService $service)
    {
        return $service->store($request);
    }

    public function show($id, EmployeeService $service)
    {
        $user = $service->show($id);

        if (!$user) {
            return response(['message' => 'Not Found'], 404);
        }

        return $user;
    }

    public function update(UpdateEmployeeRequest $request, int $id, EmployeeService $service)
    {
        return $service->update($request, $id);
    }

    public function destroy(Request $request, int $id, EmployeeService $service)
    {
        return $service->destroy($id);
    }
}
