<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Inventory;
use App\Policies\CompanyPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\InventoryPolicy;
use App\Policies\OutletPolicy;
use App\Policies\ProductPolicy;
use App\Policies\WarehousePolicy;
use App\Policies\ProductCategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        User::class => EmployeePolicy::class,
        ProductCategory::class => ProductCategoryPolicy::class,
        Inventory::class => InventoryPolicy::class,
        Outlet::class => OutletPolicy::class,
        Product::class => ProductPolicy::class,
        Warehouse::class => WarehousePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
