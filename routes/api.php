<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'suppliers'
], function ($router) {
    Route::post('/register', [SupplierController::class, 'register'])->middleware('auth:api')->name('suppliers_register');
    Route::get('/get/{id?}', [SupplierController::class, 'get'])->middleware('auth:api')->name('suppliers_get');
    Route::delete('/delete/{id}', [SupplierController::class, 'delete'])->middleware('auth:api')->name('suppliers_delete');
    Route::post('/update/{id}', [SupplierController::class, 'update'])->middleware('auth:api')->name('suppliers_update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'products'
], function ($router) {
    Route::post('/register', [ProductController::class, 'register'])->middleware('auth:api')->name('products_register');
    Route::get('/get/{id?}', [ProductController::class, 'get'])->middleware('auth:api')->name('products_get');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->middleware('auth:api')->name('products_delete');
    Route::post('/update/{id}', [ProductController::class, 'update'])->middleware('auth:api')->name('products_update');
});

Route::fallback(function () {
    abort(404);
});
