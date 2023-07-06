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

Route::get('customer', [App\Http\Controllers\API\CustomerController::class, 'index']);
Route::get('product', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('login', [App\Http\Controllers\API\CustomerController::class, 'login']);
Route::post('register', [App\Http\Controllers\API\CustomerController::class, 'register']);
Route::get('profile/{id}', [App\Http\Controllers\API\CustomerController::class, 'profile']);
Route::post('customer', [App\Http\Controllers\API\CustomerController::class, 'update']);
//Route::get('product', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::get('product/{id}', [App\Http\Controllers\API\ProductController::class, 'show']);
Route::post('order', [App\Http\Controllers\API\OrderController::class, 'order']);
Route::get('orderlist/{id}', [App\Http\Controllers\API\OrderController::class, 'orderlist']);
Route::get('orderinfo/{id}', [App\Http\Controllers\API\OrderController::class, 'orderinfo']);
Route::get('orderdetail/{id}', [App\Http\Controllers\API\OrderdetailController::class, 'orderdetail']);
Route::post('confirmorder', [App\Http\Controllers\API\OrderController::class, 'confirmorder']);

Route::get('monthlySale/{id}', [App\Http\Controllers\API\ReportController::class, 'monthlySale']);
Route::get('topFiveProduct/{id}', [App\Http\Controllers\API\ReportController::class, 'topFiveProduct']);
Route::get('cart/{id}', [App\Http\Controllers\API\OrderController::class, 'cart']);

//payment
Route::post('payment', [App\Http\Controllers\API\PaymentController::class, 'payment']);
// Route::get('payment', [App\Http\Controllers\API\PaymentController::class, 'index']);
// Route::get('payment/{id}', [App\Http\Controllers\API\PaymentController::class, 'view']);
// Route::put('payment/{id}', [App\Http\Controllers\API\PaymentController::class, 'update']);

//chat
Route::get('chat/list/{id}', [App\Http\Controllers\API\ChatController::class, 'list']);
Route::post('chat/show', [App\Http\Controllers\API\ChatController::class, 'show']);
Route::post('chat/store', [App\Http\Controllers\API\ChatController::class, 'store']);

