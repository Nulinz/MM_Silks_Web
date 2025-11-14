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
Route::post('user/login', [AdminController::class, 'login'])->name('user.login'); //login check

Route::middleware('auth')->group(function () {

    Route::post('user/logout', [AdminController::class, 'logout'])->name('user.logout'); //login check


    //  Route::post('detail', function () {
    //      return view('welcome');
    //   })->name('detail.page');


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('product-list', [CreateController::class, 'product_list'])->name('create.product-list');
    Route::get('category-list', [CreateController::class, 'category_list'])->name('create.category-list');
    Route::get('subcategory-list', [CreateController::class, 'subcategory_list'])->name('create.subcategory_list');
    Route::get('item-list', [CreateController::class, 'item_list'])->name('create.item_list');
    Route::get('color-list', [CreateController::class, 'color_list'])->name('create.color_list');
    Route::get('subcategory-wise-list', [CreateController::class, 'subcategory_wise_list'])->name('subcategory_wise_list');
    Route::get('item-details-list', [CreateController::class, 'item_details_list'])->name('create.item_details_list');

    Route::get('customer-wise-list', [CustomerController::class, 'customer_wise_list'])->name('customer_wise_list'); //new rout
    Route::get('customer-details-list', [CustomerController::class, 'customer_details_list'])->name('customer.customer_details_list');  //new route


    Route::get('customer-list', [CustomerController::class, 'customer_list'])->name('customer.customer_list');
    Route::get('customer-create-basic', [CustomerController::class, 'customer_create_basic'])->name('customer.create-basic');
    Route::get('customer-profile/{id}',  [CustomerController::class, 'customer_profile'])->name('customer.customer-profile');
    Route::get('customer-edit-basic/{id}',  [CustomerController::class, 'customer_edit_basic'])->name('customer.edit-basic');
    Route::post('/validate-phone', [CustomerController::class, 'checkPhone']);
    Route::get('/delete_customer/{id}', [CustomerController::class, 'delete_customer'])->name('delete_customer');
    Route::post('/edit-number', [CustomerController::class, 'check_edit_number']);






    Route::get('admin-list', [AdminController::class, 'admin_list'])->name('admin.admin-list');

    //category related produt fetch

    Route::post('get-categories-by-product', [CreateController::class, 'getCategories'])->name('create.getCategories');


    //customer
    Route::post('product-store', [CreateController::class, 'product_store'])->name('product_store');
    Route::post('category-store', [CreateController::class, 'category_store'])->name('category_store');
    Route::post('subcategory-store', [CreateController::class, 'subcategory_store'])->name('subcategory_store');
    Route::post('items-store', [CreateController::class, 'items_store'])->name('items_store');
    Route::post('colors-store', [CreateController::class, 'colors_store'])->name('colors_store');
    Route::post('admin-store', [AdminController::class, 'admin_store'])->name('admin_store');
    Route::post('customer-store', [CustomerController::class, 'customer_store'])->name('customer_store');

    //product status update
    Route::post('pro-status-update', [CreateController::class, 'product_status_update'])->name('create.prostatus-update');
    Route::post('cat-status-update', [CreateController::class, 'category_status_update'])->name('create.catstatus-update');
    Route::post('sub-status-update', [CreateController::class, 'subcategory_status_update'])->name('create.substatus-update');
    Route::post('item-status-update', [CreateController::class, 'item_status_update'])->name('create.item-status-update');
    Route::post('admin-status-update', [AdminController::class, 'admin_status_update'])->name('create.admin-status-update');
    Route::post('customer-status-update', [CustomerController::class, 'customer_status_update'])->name('customer-status-update');
    Route::post('color-status-update', [CreateController::class, 'color_status_update'])->name('create.colorstatus-update');

    //order
    Route::get('order-list', [OrderController::class, 'order_list'])->name('order.order-list');
    Route::get('order-profile',  [OrderController::class, 'order_profile'])->name('order.order-profile');
    Route::post('order-status-update',  [OrderController::class, 'order_status_update'])->name('order-status-update');
    Route::get('return-list', [OrderController::class, 'return_list'])->name('order.return-list');
    Route::post('/item-return/status-update', [OrderController::class, 'return_status_update'])->name('item_return.updateStatus');
    Route::post('return-code-update', [OrderController::class, 'return_code_update'])->name('return.code-update');

    Route::post('order-update-lrn', [OrderController::class, 'updateLRN'])->name('order.update-lrn');

    Route::post('/check-barcode', [OrderController::class, 'checkBarcode'])->name('check.barcode');
    Route::post('/submit-cart', [OrderController::class, 'submitCart'])->name('submit.cart');   //new





    //edit
    Route::post('product-edit', [EditController::class, 'edit_product'])->name('edit.product-profile');
    Route::post('category-edit', [EditController::class, 'edit_category'])->name('edit.category-profile');
    Route::post('subcategory-edit', [EditController::class, 'edit_subcategory'])->name('edit.subcategory-profile');
    Route::post('items-edit', [EditController::class, 'edit_items'])->name('edit.items-profile');
    Route::post('color-edit', [EditController::class, 'edit_color'])->name('edit.color-profile');

    Route::post('admin-edit', [AdminController::class, 'edit_admin'])->name('admin_edit');
});



//});

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('pages.index');

//footer page 
Route::get('contact', [HomeController::class, 'footer_contact'])->name('footer.contact');  //new


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
