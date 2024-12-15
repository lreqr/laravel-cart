<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ru']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('cart/data', [CartController::class, 'getCartData'])->name('cart.getData');
    Route::delete('cart/delete', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('cart/update', [CartController::class, 'update'])->name('cart.update');

});

Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});
