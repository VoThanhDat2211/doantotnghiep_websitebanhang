<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Models\ProductVariant;

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
        Route::delete('{id}/delete', [AdminController::class, 'deleteCategory'])->name('admin-category-delete');
    });
    // product
    Route::prefix('product')->middleware('auth:admin')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('admin-product-list');
        Route::get('/form-create-product', [ProductController::class, 'create'])->name('admin-product-form-create');
        Route::post('/create', [ProductController::class, 'store'])->name('admin-product-create');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin-product-form-update');
        Route::put('/update', [ProductController::class, 'update'])->name('admin-product-update');
        Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('admin-product-delete');
        Route::get('{id}/images', [ProductController::class, 'getImage'])->name('admin-product-image');
        Route::get('{id}/images/create', [ProductController::class, 'createImage'])->name('admin-product-image-form');
        Route::post('{id}/images/create', [ProductController::class, 'storeImage'])->name('admin-product-image-create');
        Route::delete('/image/{id}/delete', [ProductController::class, 'deleteImage'])->name('admin-image-delete');
        Route::prefix('/{id}/product-variant')->group(function () {
            Route::get('/list', [ProductVariantController::class, 'index'])->name('admin-product-variant-list');
            Route::get('/create', [ProductVariantController::class, 'create'])->name('admin-product-variant-form-create');
            Route::post('/create', [ProductVariantController::class, 'store'])->name('admin-product-variant-create');
            Route::get('{product_variant_id}/edit', [ProductVariantController::class, 'edit'])->name('admin-product-variant-form-update');
        });
    });
});