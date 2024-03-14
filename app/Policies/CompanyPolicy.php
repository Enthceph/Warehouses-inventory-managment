<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Company $company)
    {
        return $user->company_id === $company->id;
    }

    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Company $company)
    {
        if ($user->isOwner() && $user->company_id === $company->id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Company $company)
    {
        if ($user->isOwner() && $user->company_id === $company->id) {
            return true;
        }
        return false;
    }

    public function restore(User $user)
    {
        return $user->isAdmin();
    }
}
