<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;

/* login */

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/* dashboard */

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/* discounts */

Route::resource('discount', DiscountController::class);
Route::post('/discounts', [DiscountController::class, 'store'])->name('discounts.store');
Route::get('/discount/delete/{id}', [DiscountController::class, 'delete'])->name('discount.delete');
Route::put('discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');

Route::fallback(function () {
    return redirect('/login');
});
