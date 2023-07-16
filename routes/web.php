<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

//在這個Route才去使用 這'verified'的 middleware
// Route::group(
//     [
//         'middleware' => 'verified'
//     ],
//     function(){
//         Route::resource('fakeProducts', 'FakeProductController');
//     }
// );


// Route::group([
//     'middleware' =>'check.dirty'
// ], function(){
//     Route::resource('products', 'ProductController'); 
// });
Route::get('/', 'WebController@index');
Route::get('/contact_us', 'WebController@contactUs');
Route::post('/read-notification', 'WebController@readNotification');
Route::post('/products/check_product', 'ProductController@checkProduct');
Route::get('/products/{id}/shared-url', 'ProductController@sharedUrl');
Route::resource('products', 'ProductController');

Route::resource('admin/orders', 'Admin\OrderController');
Route::resource('admin/products'   , 'Admin\ProductController');
Route::post('admin/products/upload-image', 'Admin\ProductController@uploadImage');
Route::post('admin/products/excel/import', 'Admin\ProductController@import');

Route::post('admin/orders/{id}/delivery', 'Admin\OrderController@delivery');
Route::get('/admin/orders/excel/export', 'Admin\OrderController@export');
Route::get('/admin/orders/excel/export-by-shipped', 'Admin\OrderController@exportByShipped');
Route::post('admin/tools/update-product-price', 'Admin\ToolController@updateProductPrice');
Route::post('admin/tools/create-product-redis', 'Admin\ToolController@createProductRedis');


Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');
Route::group([
    'middleware' =>'auth:api' //  auth.api:原生用來檢查token的
],function(){
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
    //---------------------使用購物車,先經過token的檢查-------------------
    Route::post('carts/checkout', 'CartController@checkout');
    Route::resource('carts', 'CartController'); 
    Route::resource('cart_items', 'CartItemController');
});