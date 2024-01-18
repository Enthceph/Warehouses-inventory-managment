<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function get()
    {
        $companyId = Auth::user()->company->id;
        $users = User::where('company_id', $companyId)->get();

        $users->transform(function ($item) {
            return $item->only(['id', 'full_name', 'email', 'role_id', 'created_at']);
        });

        return $users;
    }

    public function show(int $id)
    {
        $user = Auth::user();
        if ($user->id !== $id) {
            return response(['message' => 'You are not allowed to get that user'], 403);
        }

        return $user;
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $user = Auth::user();
        if ($user->id !== $id) {
            return response(['message' => 'You are not allowed to update that user'], 403);
        }

        if ($request->has('company_id') && Auth::user()->role_id !== 1) {
            return response(['message' => 'You are not allowed to change that user\'s company'], 403);
        }

        $user->update($request->all());

        return $user;
    }
}
