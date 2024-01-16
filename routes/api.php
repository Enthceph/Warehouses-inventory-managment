<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::patch('changePassword', 'changePassword');
        Route::get('checkAuth', 'checkAuth');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'user');
        Route::patch('changeName', 'changeName');
    });
    Route::resource('user', UserController::class);

    Route::resource('warehouse', WarehouseController::class);
    Route::post('getWarehouseInventory', [WarehouseController::class, 'getWarehouseInventory']);
    Route::resource('inventory', InventoryController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('employee', EmployeeController::class);
//    Route::resource('role', RoleController::class);
    Route::get('role', [RoleController::class, 'index']);

});
//ДЛЯ GUARDов
//        Route::patch('changeName', 'changeName')->middleware('restrictRole:admin');
