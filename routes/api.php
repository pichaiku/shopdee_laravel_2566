<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//customer
Route::get('customer', [App\Http\Controllers\API\CustomerController::class, 'index']);
Route::post('register', [App\Http\Controllers\API\CustomerController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\CustomerController::class, 'login']);
Route::get('profile/{id}', [App\Http\Controllers\API\CustomerController::class, 'profile']);
Route::post('customer', [App\Http\Controllers\API\CustomerController::class, 'update']);

//product
Route::get('product', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::get('product/{id}', [App\Http\Controllers\API\ProductController::class, 'show']);

//order
Route::post('makeorder', [App\Http\Controllers\API\OrderController::class, 'makeorder']);
Route::post('confirmorder', [App\Http\Controllers\API\OrderController::class, 'confirmorder']);
Route::get('cart/{id}', [App\Http\Controllers\API\OrderController::class, 'cart']);
Route::get('orderdetail/{id}', [App\Http\Controllers\API\OrderdetailController::class, 'orderdetail']);
Route::get('history/{id}', [App\Http\Controllers\API\OrderController::class, 'history']);
Route::get('orderinfo/{id}', [App\Http\Controllers\API\OrderController::class, 'orderinfo']);

//payment
Route::post('payment', [App\Http\Controllers\API\PaymentController::class, 'payment']);

//dashboard
Route::get('monthlySale/{id}', [App\Http\Controllers\API\ReportController::class, 'monthlySale']);
Route::get('topFiveProduct/{id}', [App\Http\Controllers\API\ReportController::class, 'topFiveProduct']);

//chat
Route::get('chat/list/{id}', [App\Http\Controllers\API\ChatController::class, 'list']);
Route::post('chat/store', [App\Http\Controllers\API\ChatController::class, 'store']);
Route::post('chat/show', [App\Http\Controllers\API\ChatController::class, 'show']);

