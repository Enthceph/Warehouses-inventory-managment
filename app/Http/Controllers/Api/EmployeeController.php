<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function index(EmployeeService $service)
    {
        return $service->getOrganisationEmployees();
    }

    public function store(StoreEmployeeRequest $request, EmployeeService $service)
    {
        $service->store($request);

        return response(['message' => 'Employee created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id, EmployeeService $service)
    {
        $user = $service->show($id);

        if (!$user) {
            return response(['message' => 'Not Found'], 404);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id, EmployeeService $service)
    {
        return $service->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
