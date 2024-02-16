<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
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

    public function update(User $user, ProductCategory $category)
    {
        if ($user->isOwner() && $user->company_id === $category->company_id) {
            return true;
        }
        return false;
    }

    public function show(User $user, ProductCategory $category)
    {
        if ($user->company_id === $category->company_id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, ProductCategory $category)
    {
        if ($user->isOwner() && $user->company_id === $category->company_id) {
            return true;
        }
        return false;
    }
}
