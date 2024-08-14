<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[HomeController::class,'index'])->name('home_page_user');
Route::get('/login', [FrontendController::class, 'login'])->name('user-form-login');
Route::post("/post-login", [FrontendController::class, 'authenticate'])->name('user-login');
Route::get('/logout', [FrontendController::class, 'logout'])->name('user-logout');