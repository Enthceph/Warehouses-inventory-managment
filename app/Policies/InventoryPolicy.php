<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class InventoryPolicy
{
    use HandlesAuthorization;


    public function view() : bool
    {
        return true;
    }

    public function store() : bool
    {
        return true;
    }

    public function update(User $user, Inventory $inventory) : bool
    {
        return $user->company_id === $inventory->warehouse->company_id;
    }

    public function show(User $user, Inventory $inventory) : bool
    {
        return $user->company_id === $inventory->warehouse->company_id;
    }

    public function delete(User $user, Inventory $inventory) : bool
    {
        return $user->company_id === $inventory->warehouse->company_id;
    }
}
