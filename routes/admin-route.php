<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

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
        Route::get('/{id}/edit', [AdminController::class, 'getFormUpdateCategory'])->name('admin-category-form-update');
        Route::put('/update', [AdminController::class, 'updateCategory'])->name('admin-category-update');
    });
    // product
    Route::prefix('product')->middleware('auth:admin')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('admin-product-list');
        Route::get('/form-create-product', [ProductController::class, 'create'])->name('admin-product-form-create');
        Route::post('/create', [ProductController::class, 'store'])->name('admin-product-create');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin-product-form-update');
        Route::put('/update', [ProductController::class, 'update'])->name('admin-product-update');
        Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('admin-product-delete');
    });
});