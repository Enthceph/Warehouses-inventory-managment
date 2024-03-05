<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return User::where('company_id', Auth::user()->company->id)->with(['role', 'company'])->get();
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

    public function store(StoreUserRequest $request)
    {
        return User::create($request->validated());
    }

    public function show(innt $id)
    {
        return User::findOrFail($id);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except(['id']));
        $user->save();
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete())
            return response(null, 204);
    }
}
