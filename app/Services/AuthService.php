<?php

namespace App\Services;


use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserAndCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(CreateUserAndCompanyRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user_data = $request->user_data;
            $company_data = $request->company_data;

            $user = User::create([
                'full_name' => $user_data['full_name'],
                'email' => $user_data['email'],
                'role_id' => 2,
                'password' => Hash::make($user_data['password']),
            ]);

            $user->createToken("API TOKEN")->plainTextToken;

            $company = Company::create([
                'name' => $company_data['name'],
                'address' => $company_data['address'],
                'contact_info' => $company_data['contact_info'],
                'owner_id' => $user['id']
            ]);
        });
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response('Email & Password does not match with our record.', 401);
        }

        $user = User::where('email', $request->email)->first();
        $accessToken = $user->createToken("API TOKEN")->plainTextToken;

        return $accessToken;
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
    }

    public function checkAuth()
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        Auth::user()->update(['password' =>
            Hash::make($request['new_password'])
        ]);
    }
}
