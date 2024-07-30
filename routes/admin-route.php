<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/login', [AdminController::class, 'getLogin']);
    Route::post("/login", [AdminController::class, 'authenticate'])->name('admin.login');
});