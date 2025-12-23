<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/products');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::post('logout', [LogoutController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductsController::class, 'view'])->name('products.view');
});
