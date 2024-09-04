<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[FrontendController::class,'home'])->name('home_page_user');
Route::prefix('/')->middleware('guest')->group(function () { 
    Route::get('/login', [FrontendController::class, 'login'])->name('user-form-login');
    Route::post("/post-login", [FrontendController::class, 'authenticate'])->name('user-login');
    Route::get('/register', [FrontendController::class,'register'])->name('user-form-register');
    Route::post("/post-register", [FrontendController::class, 'postRegister'])->name('user-register');
});
Route::get('/logout', [FrontendController::class, 'logout'])->name('user-logout');
Route::get('/{parent_category}', [FrontendController::class, 'getByParentCategory'])->name('products-by-parent-category');
// Route::prefix('/')->middleware('auth')->group(function () {
//     Route::get('/shopping-cart', [FrontendController::class, 'getCart'])->name('user-cart');
//     Route::get('/pay', [FrontendController::class, 'getPay'])->name('user-pay');
// });
// Route::get('/home/checkout', [FrontendController::class, 'getPay'])->name('user-pay');
Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/purchase', [FrontendController::class, 'getOrderHistory'])->name('user-order-history');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('user-add-to-cart');
    Route::get('/shopping-cart', [FrontendController::class, 'getCart'])->name('user-cart');
    Route::post('/handle-pay', [FrontendController::class, 'handlePay'])->name('user-handle-pay');
    Route::get('/checkout', [FrontendController::class, 'getPay'])->name('user-pay');
    Route::get('/checkout-by-cart', [FrontendController::class, 'getPayByCart'])->name('user-pay-by-cart');
    Route::get('/handle-checkout-by-cart', [CartController::class, 'handleCheckoutByCart'])->name('handle-checkout-by-cart');
    Route::post('/create-pay-by-cart', [PayController::class, 'create'])->name('create-pay-by-cart');
});
Route::get('/{id}/product-detail', [FrontendController::class, 'getProductDetail'])->name('product-detail');