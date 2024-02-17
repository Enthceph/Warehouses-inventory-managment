<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return true;
    }

    public function create()
    {
        return true;
    }

    public function update(User $user, Inventory $inventory)
    {
        if ($user->company_id === $inventory->warehouse->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, Inventory $inventory)
    {
        if ($user->company_id === $inventory->warehouse->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Inventory $inventory)
    {
        if ($user->company_id === $inventory->warehouse->company_id) {
            return true;
        }
        return false;
    }
}
