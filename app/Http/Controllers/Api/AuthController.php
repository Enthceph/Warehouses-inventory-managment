<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangeNameRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterOwnerAndCompanyRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    public function register(RegisterOwnerAndCompanyRequest $request)
    {
        $this->service->register($request);
    }

    public function login(LoginRequest $request): Response
    {
        if (!Auth::attempt($request->validated())) {
            return response(['message' => 'Email or Password does not match with our record'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $accessToken = $user->createToken("API TOKEN")->plainTextToken;

        return response(['accessToken' => $accessToken]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
    }

    public function checkAuth()
    {
        Auth::check();
    }

    public function getAuthUser(): array
    {
        $user = Auth::user()->load('role', 'company');
        return [
            'id' => $user->id,
            'fullName' => $user->full_name,
            'email' => $user->email,
            'role' => $user->role->name,
            'company' => $user->company->name,
            'createdAt' => $user->created_at
        ];
    }

    public function changeName(ChangeNameRequest $request)
    {
        Auth::user()->update(['full_name' => $request['name']]);
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        Auth::user()->update($request->validated());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        Auth::user()->update(['password' => Hash::make($request['new_password'])]);
    }
}
