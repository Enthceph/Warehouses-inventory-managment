<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserAndCompanyRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(CreateUserAndCompanyRequest $request, AuthService $service)
    {
        $service->register($request);

        return response(['message' => 'User created'], 200);
    }

    public function login(Request $request, AuthService $service)
    {
        $accessToken = $service->login($request);

        return [
            'access_token' => $accessToken
        ];
    }

    public function changePassword(ChangePasswordRequest $request, AuthService $service)
    {
        $service->changePassword($request);

        return response(['message' => 'Пароль был обновлен']);
    }

    public function logout(Request $request, AuthService $service)
    {
        $service->logout();
        return response(['message' => 'User logged out'], 200);
    }

    public function checkAuth(AuthService $service)
    {
        return $service->checkAuth();
    }
}
