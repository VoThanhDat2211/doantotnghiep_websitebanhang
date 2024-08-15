<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[FrontendController::class,'home'])->name('home_page_user');
Route::get('/login', [FrontendController::class, 'login'])->name('user-form-login');
Route::post("/post-login", [FrontendController::class, 'authenticate'])->name('user-login');
Route::get('/logout', [FrontendController::class, 'logout'])->name('user-logout');
Route::get('/shopping-cart', [FrontendController::class, 'getCart'])->name('user-cart');
Route::get('/pay', [FrontendController::class, 'getPay'])->name('user-pay');