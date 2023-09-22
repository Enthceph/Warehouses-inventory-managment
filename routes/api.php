<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BudgetFormController;
use App\Http\Controllers\Api\BudgetHistoryController;
use App\Http\Controllers\Api\BudgetReportController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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

        Route::get('currentMonthBudget', 'currentMonthBudget');
    });

    Route::controller(BudgetFormController::class)->group(function () {
        Route::post('newIncome', 'newIncome');
        Route::post('newExpense', 'newExpense');

        Route::get('getIncomeCategories', 'getIncomeCategories');
        Route::get('getExpenseCategories', 'getExpenseCategories');

        Route::get('getAllCategories', 'getAllCategories');
        Route::get('getAllCategoriesWithKeys', 'getAllCategoriesWithKeys');
    });

    Route::apiResource('budgetHistory', BudgetHistoryController::class);
    Route::apiResource('budgetReport', BudgetReportController::class);
});
