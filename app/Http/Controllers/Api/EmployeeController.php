<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
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
        $service->store($request);

        return response(['message' => 'Employee created'], 200);
    }

    public function show($id, EmployeeService $service)
    {
        $user = $service->show($id);

        if (!$user) {
            return response(['message' => 'Not Found'], 404);
        }

        return $user;
    }

    public function update(Request $request, int $id, EmployeeService $service)
    {
        return $service->update($request, $id);
    }

    public function destroy(Request $request, int $id, EmployeeService $service)
    {
        return $service->destroy($id);
    }
}
