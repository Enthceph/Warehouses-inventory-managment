<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function view() : bool
    {
        return true;
    }

    public function store(User $user) : bool
    {
        return $user->isOwner();
    }

    public function update(User $user, User $employee) : bool
    {
        return $user->isOwner() && $user->company_id === $employee->company_id;
    }

    public function show(User $user, User $employee) : bool
    {
        return $user->company_id === $employee->company_id;
    }

    public function delete(User $user, User $employee) : bool
    {
        return $user->isOwner() && $user->company_id === $employee->company_id;
    }
}
