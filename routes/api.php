<?php

use App\Http\Controllers\CartApiController;
use App\Http\Controllers\FrontendControllerApi;
use App\Http\Controllers\ProductVariantApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-image-and-size', [ProductVariantApiController::class, 'getImageAndSize'])->name('get-image-and-size');
Route::get('/get-quantity', [ProductVariantApiController::class, 'getQuantity'])->name('get-quantity');
Route::get('/get-remain-quantity', [ProductVariantApiController::class, 'getRemainQuantity'])->name('get-remain-quantity');
Route::get('/get-new-value', [CartApiController::class, 'getNewValue'])->name('get-new-value');
Route::get('/get-voucher', [FrontendControllerApi::class, 'getByVoucherCodeCondition'])->name('get-voucher');