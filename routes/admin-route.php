<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'getLogin'])->name('admin-form-login')->middleware('guest:admin');
    Route::post("/post-login", [AdminController::class, 'authenticate'])->name('admin-login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin-logout');
    // dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard')->middleware("auth:admin");
    // category
    Route::prefix('category')->middleware('auth:admin')->group(function () {
        Route::get('/list', [AdminController::class, 'getCategoryList'])->name('admin-category-list');
        Route::get('/form-create-category', [AdminController::class, 'getFormCreateCategory'])->name('admin-category-form-create');
        Route::post('/create', [AdminController::class, 'createCategory'])->name('admin-category-create');
    });
});