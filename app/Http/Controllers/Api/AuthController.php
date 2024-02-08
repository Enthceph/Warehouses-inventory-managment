<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangeNameRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserAndCompanyRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    )
    {
    }

    public function register(CreateUserAndCompanyRequest $request)
    {
        $this->service->register($request);

        return response(['message' => 'User created'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response(['message' => 'Email or Password does not match with our record'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $accessToken = $user->createToken("API TOKEN")->plainTextToken;

        return ['access_token' => $accessToken];
    }

    public function logout()
    {
        if (Auth::user()->currentAccessToken()->delete()) {
            return response()->json(['message' => true]);
        }

        return response()->json(['message' => false], 500);
    }

    public function checkAuth()
    {
        if (Auth::check()) {
            return response()->json(['message' => true]);
        }

        return response()->json(['message' => false], 401);
    }

    public function getAuthUser(): array
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

    public function changeName(ChangeNameRequest $request)
    {
        Auth::user()->update(['full_name' => $request['name']]);

        return response(['message' => 'Имя было обновлено']);
    }

    public function changeEmail(ChangeEmailRequest $request)
    {
        Auth::user()->update(['email' => $request['email']]);

        return response(['message' => 'Email был обновлен']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        Auth::user()->update(['password' =>
            Hash::make($request['new_password'])
        ]);

        return response(['message' => 'Пароль был обновлен']);
    }


}
