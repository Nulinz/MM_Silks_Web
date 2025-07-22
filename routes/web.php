<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController; // ✅ import your controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrderController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['web', 'auth:webadmin'])->group(function () {
    
// Route::middleware(['web', 'auth:web'])->group(function () {

    Route::view('/admin', 'login')->name('login');
    Route::post('user/login', [AdminController::class,'login'])->name('user.login');//login check
    Route::post('user/logout', [AdminController::class,'logout'])->name('user.logout');//login check
 
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('product-list', [CreateController::class,'product_list'])->name('create.product-list');
    Route::get('category-list', [CreateController::class,'category_list'])->name('create.category-list');
    Route::get('subcategory-list', [CreateController::class,'subcategory_list'])->name('create.subcategory_list');
    Route::get('item-list', [CreateController::class,'item_list'])->name('create.item_list');
    Route::get('customer-list', [CustomerController::class,'customer_list'])->name('customer.customer_list');
    Route::get('customer-create-basic', [CustomerController::class,'customer_create_basic'])->name('customer.create-basic');
    Route::get('admin-list', [AdminController::class,'admin_list'])->name('admin.admin-list');

    //category related produt fetch

    Route::post('get-categories-by-product', [CreateController::class, 'getCategories'])->name('getCategories');


    //customer
    Route::post('product-store', [CreateController::class,'product_store'])->name('product_store');
    Route::post('category-store', [CreateController::class,'category_store'])->name('category_store');
    Route::post('subcategory-store', [CreateController::class,'subcategory_store'])->name('subcategory_store');
    Route::post('items-store', [CreateController::class,'items_store'])->name('items_store');
    Route::post('admin-store', [AdminController::class,'admin_store'])->name('admin_store');
    Route::post('customer-store', [CustomerController::class,'customer_store'])->name('customer_store');

    //product status update
    Route::post('pro-status-update', [CreateController::class,'product_status_update'])->name('create.prostatus-update');
    Route::post('cat-status-update', [CreateController::class,'category_status_update'])->name('create.catstatus-update');
    Route::post('sub-status-update', [CreateController::class,'subcategory_status_update'])->name('create.substatus-update');
    Route::post('item-status-update', [CreateController::class,'item_status_update'])->name('create.item-status-update');
    Route::post('admin-status-update', [AdminController::class,'admin_status_update'])->name('create.admin-status-update');
    Route::post('customer-status-update', [CustomerController::class,'customer_status_update'])->name('customer-status-update');

    //order
    Route::get('order-list', [OrderController::class,'order_list'])->name('order.order-list');
    Route::get('order-profile',  [OrderController::class,'order_profile'])->name('order.order-profile');
    Route::post('order-status-update',  [OrderController::class,'order_status_update'])->name('order-status-update');
    
    //edit
    Route::post('product-edit', [EditController::class,'edit_product'])->name('edit.product-profile');
    Route::post('category-edit', [EditController::class,'edit_category'])->name('edit.category-profile');
    Route::post('subcategory-edit', [EditController::class,'edit_subcategory'])->name('edit.subcategory-profile');
    Route::post('items-edit', [EditController::class,'edit_items'])->name('edit.items-profile');








//});

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('pages.index');

    // Contact Us
    Route::get('about-us', 'HomeController@aboutus')->name('pages.about-us');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('pages.contact-us');

    // Terms & Conditions
    Route::get('terms-and-conditions', 'HomeController@terms')->name('pages.terms-and-conditions');

    // Privacy Policy
    Route::get('privacy-policy', 'HomeController@privacy')->name('pages.privacy-policy');

    // Refund Policy
    Route::get('refund-policy', 'HomeController@refund')->name('pages.refund-policy');

