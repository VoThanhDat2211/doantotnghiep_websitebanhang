<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[FrontendController::class,'home'])->name('home_page_user');
Route::prefix('/')->middleware('guest')->group(function () { 
    Route::get('/login', [FrontendController::class, 'login'])->name('user-form-login');
    Route::post("/post-login", [FrontendController::class, 'authenticate'])->name('user-login');
    Route::get('/register', [FrontendController::class,'register'])->name('user-form-register');
    Route::post("/post-register", [FrontendController::class, 'postRegister'])->name('user-register');
});
Route::get('/logout', [FrontendController::class, 'logout'])->name('user-logout');
Route::get('/{parent_category}/categories', [FrontendController::class, 'getByParentCategory'])->name('products-by-parent-category');
Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/shopping-cart', [FrontendController::class, 'getCart'])->name('user-cart');
    Route::get('/pay', [FrontendController::class, 'getPay'])->name('user-pay');
});
Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/purchase', [FrontendController::class, 'getOrderHistory'])->name('user-order-history');
});
Route::get('/product-detail', [FrontendController::class, 'getProductDetail'])->name('product-detail');