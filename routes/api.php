<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCustomerController;

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

Route::post('login', [ApiCustomerController::class, 'login']);
Route::get('product_list', [ApiCustomerController::class, 'product_list']);
Route::get('category_list', [ApiCustomerController::class, 'category_list']);
Route::get('subcategory_list', [ApiCustomerController::class, 'subcategory_list']);
Route::get('items_list', [ApiCustomerController::class, 'items_list']);
Route::post('cart_add', [ApiCustomerController::class, 'addToCart']);
Route::get('mycart', [ApiCustomerController::class, 'viewCart']);
Route::post('cart_delete', [ApiCustomerController::class, 'deleteCartItem']);
Route::post('cart_count', [ApiCustomerController::class, 'cartcount']);
Route::post('order_place', [ApiCustomerController::class, 'placeOrder']);
Route::post('order_details', [ApiCustomerController::class, 'getOrderDetails']);
Route::post('order_summary', [ApiCustomerController::class, 'order_summary']);
Route::post('update_popup', [ApiCustomerController::class, 'popup']);
Route::post('update_token', [ApiCustomerController::class, 'update_token']);
Route::post('logout', [ApiCustomerController::class, 'logout']);
Route::post('order_return', [ApiCustomerController::class, 'order_return']);
Route::post('price_filter', [ApiCustomerController::class, 'price_filter']);
Route::get('color_filter', [ApiCustomerController::class, 'color_filter']);
Route::get('color_list', [ApiCustomerController::class, 'color_list']);






