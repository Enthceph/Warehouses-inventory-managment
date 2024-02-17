<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function update(User $user, Product $product)
    {
        if ($user->isOwner() && $user->company_id === $product->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, Product $product)
    {
        if ($user->company_id === $product->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Product $product)
    {
        if ($user->isOwner() && $user->company_id === $product->company_id) {
            return true;
        }
        return false;
    }
}
