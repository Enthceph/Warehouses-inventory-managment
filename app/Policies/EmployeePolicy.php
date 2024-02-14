<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        if ($user->isOwner()) {
            return true;
        }
        return false;
    }

    public function update(User $user, User $employee): bool
    {
        if ($user->isOwner() && $user->company_id === $employee->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, User $employee)
    {
        if ($user->company_id === $employee->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, User $employee)
    {
        if ($user->isOwner() && $user->company_id === $employee->company_id) {
            return true;
        }
        return false;
    }
}
