<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiOrderItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('order')->group(function () {
    Route::get('/orders_item/{id}', [ApiOrderItemController::class, 'index']);
    Route::post('/orders_item/{id}', [ApiOrderItemController::class, 'store']);
    Route::get('{order_id}/orders_item/edit/{id}', [ApiOrderItemController::class, 'edit']);
    Route::put('{order_id}/orders_item/edit/{id}', [ApiOrderItemController::class, 'update']);
    Route::delete('{order_id}/orders_item/delete/{id}', [ApiOrderItemController::class, 'destroy']);
    Route::get('/orders_item/{id}/search/{keyword}', [ApiOrderItemController::class, 'search']);
});