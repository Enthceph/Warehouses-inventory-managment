<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\ProductCategoriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::delete('logout', 'logout');
        Route::get('getAuthUser', 'getAuthUser');
        Route::get('checkAuth', 'checkAuth');
        Route::patch('changeName', 'changeName');
        Route::patch('changeEmail', 'changeEmail');
        Route::patch('changePassword', 'changePassword');
    });

    Route::apiResource('warehouse', WarehouseController::class);
    Route::apiResource('outlet', OutletController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('productCategory', ProductCategoriesController::class);

    Route::apiResource('role', RoleController::class)->only('index');

    Route::apiResource('inventory', InventoryController::class);
    Route::get('getAnalyticsFilterInfo', [InventoryController::class, 'getAnalyticsFilterInfo']);
});