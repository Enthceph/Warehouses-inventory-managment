<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
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

    public function update(User $user, Warehouse $warehouse): bool
    {
        if ($user->isOwner() && $user->company_id === $warehouse->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, Warehouse $warehouse)
    {
        if ($user->company_id === $warehouse->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Warehouse $warehouse)
    {
        if ($user->isOwner() && $user->company_id === $warehouse->company_id) {
            return true;

        }
        return false;
    }
}
