<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(UserService $service)
    {
        return $service->get();
    }


    public function show($id, UserService $service)
    {
        return $service->show($id);
    }

    public function update(UpdateUserRequest $request, int $id, UserService $service)
    {
        return $service->update($request, $id);
    }

    public function user()
    {
        $user = Auth::user();

        if ($user) {
            $userPublic = $user->only(['full_name', 'email']);
            $userPublic['role'] = $user->role->role;

            return response()->json($userPublic);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

}
