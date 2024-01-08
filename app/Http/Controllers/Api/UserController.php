<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function changeName(Request $request)
    {
//        TODO этот return возвращает 1 или 0
        return Auth::user()->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name']
        ]);
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

    public function getUserOrganisation()
    {
        return response(Company::where('owner_id', Auth::id())->first());
    }

}
