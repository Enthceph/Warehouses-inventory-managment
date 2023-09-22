<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     */
    public function register(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->createToken("API TOKEN")->plainTextToken;

        return response(['message' => 'User created'],200);
    }

    /**
     * Login The User
     * @param Request $request
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response('Email & Password does not match with our record.', 401);
        }

        $user = User::where('email', $request->email)->first();
        $accessToken = $user->createToken("API TOKEN")->plainTextToken;

        return [
            'access_token' => $accessToken
        ];
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        Auth::user()->update(['password' =>
            Hash::make($request['new_password'])
        ]);

        return response("Пароль был обновлен на $request->new_password");
    }

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response('User logged out', 200);
    }

    public function checkAuth()
    {
        if (Auth::check()) {
            return response(true);
        }

        return response(false);
    }
}
