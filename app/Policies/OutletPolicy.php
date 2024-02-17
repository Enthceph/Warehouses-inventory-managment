<?php

namespace App\Policies;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutletPolicy
{
    use HandlesAuthorization;

    public function view()
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

    public function update(User $user, Outlet $outlet)
    {
        if ($user->isOwner() && $user->company_id === $outlet->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, Outlet $outlet)
    {
        if ($user->company_id === $outlet->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Outlet $outlet)
    {
        if ($user->isOwner() && $user->company_id === $outlet->company_id) {
            return true;
        }
        return false;
    }
}
