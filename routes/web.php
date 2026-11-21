<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', fn () => redirect()->route('menus.index'));

    Route::middleware('role:admin')->group(function () {
        Route::resource('menus', MenuController::class)->except(['index', 'show']);

        Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'destroy']);
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
    });

    Route::resource('menus', MenuController::class)->only(['index', 'show']);

    Route::middleware('role:admin,kasir,waiter')->group(function () {
        Route::post('/menus/{menu}/order', [OrderController::class, 'store'])->name('orders.store');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
});