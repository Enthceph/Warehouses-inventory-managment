<?php

namespace App\Services;

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
}
