<?php

use App\Http\Controllers\Api\V1\Admin\CategoryController;
use App\Http\Controllers\Api\V1\Client\CustomerAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\V1\Admin\AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Api\V1\Admin\AuthController::class, 'logout']);
    });

    Route::prefix('v1')->middleware('auth:api')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/create', [CategoryController::class, 'create']);
            Route::post('/store', [CategoryController::class, 'store']);
            Route::get('/edit/{category}', [CategoryController::class, 'edit']);
            Route::post('/update/{category}', [CategoryController::class, 'update']);
            Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
        });
    });
});

Route::prefix('customer')->group(function () {
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::post('/register', [CustomerAuthController::class, 'register']);

    Route::middleware('auth:customer')->group(function () {
        Route::post('/logout', [CustomerAuthController::class, 'logout']);
        Route::get('/profile', function () {
            return response()->json(\App\Models\Customer::all());
        });
    });
})->middleware(['auth:customer', 'scopes:customer']);

