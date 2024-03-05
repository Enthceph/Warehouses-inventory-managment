<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\ProductCategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::delete('logout', 'logout');
        Route::get('checkAuth', 'checkAuth');
        Route::get('getAuthUser', 'getAuthUser');
        Route::patch('changeName', 'changeName');
        Route::patch('changeEmail', 'changeEmail');
        Route::patch('changePassword', 'changePassword');
    });

    Route::resource('warehouse', WarehouseController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('productCategory', ProductCategoriesController::class);

    Route::get('role', [RoleController::class, 'index']);
});
