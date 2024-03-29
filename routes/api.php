<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Controllers
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('store', StoreController::class);
Route::get('store-index-with-products', [StoreController::class, 'indexWithProducts']);
Route::get('store-show-with-products/{id}', [StoreController::class, 'showWithProducts']);

Route::apiResource('product', ProductController::class);
Route::get('product-index-with-store', [ProductController::class, 'indexWithStore']);
Route::get('product-show-with-store/{id}', [ProductController::class, 'showWithStore']);
