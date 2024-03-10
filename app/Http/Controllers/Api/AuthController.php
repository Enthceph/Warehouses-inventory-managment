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
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    public function register(RegisterOwnerAndCompanyRequest $request) : Response
    {
        $this->service->register($request);

        return response(['message' => 'User created']);
    }

    public function login(LoginRequest $request) : Response
    {
        if (! Auth::attempt($request->validated())) {
            return response(['message' => 'Email or Password does not match with our record'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $accessToken = $user->createToken("API TOKEN")->plainTextToken;

        return response(['access_token' => $accessToken]);
    }

    public function logout() : Response
    {
        if (Auth::user()->currentAccessToken()->delete()) {
            return response(['message' => true]);
        }

        return response(['message' => false], 500);
    }

    public function checkAuth() : Response
    {
        if (Auth::check()) {
            return response(['message' => true]);
        }

        return response(['message' => false], 401);
    }

    public function getAuthUser() : array
    {
        $user = Auth::user()->load('role', 'company');
        return [
            'id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'role' => $user->role->name,
            'company' => $user->company->name,
            'created_at' => $user->created_at
        ];
    }

    public function changeName(ChangeNameRequest $request) : Response
    {
        Auth::user()->update(['full_name' => $request['name']]);

        return response(['message' => 'Name successfully updated']);
    }

    public function changeEmail(ChangeEmailRequest $request) : Response
    {
        Auth::user()->update($request->validated());

        return response(['message' => 'Email successfully updated']);
    }

    public function changePassword(ChangePasswordRequest $request) : Response
    {
        Auth::user()->update(['password' => Hash::make($request['new_password'])]);

        return response(['message' => 'Password successfully updated']);
    }
}
