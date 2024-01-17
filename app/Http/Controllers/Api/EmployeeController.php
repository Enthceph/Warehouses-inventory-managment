<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $authUser = Auth::user();

        if ($authUser->role->name == "Owner") {
            $user = User::findOrFail($id);
            if ($user['company_id'] !== $authUser['company_id']) {
                return response(['message' => "You are unauthorized to set a role to that user1..." . "Rcompany_id: " . $request['company_id'] . " Acompany_id: " . $authUser['company_id']], 401);
            }
        } else if (Auth::id() !== $request['id']) {

            return response(['message' => 'You are unauthorized to set a role to that user2...'], 401);
        }

        return $service->update($request, $id);
    }

    public function destroy(Request $request, int $id, EmployeeService $service)
    {
        return $service->destroy($id);
    }
}
