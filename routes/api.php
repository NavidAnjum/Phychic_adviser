<?php

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

include 'auth.php';


Route::get('/product/details/{id}/{product_name}', 'ProductController@ProductView');    //showing_Products_deatails

Route::post('/cart/product/add/{id}', 'ProductController@AddCart');

//for subcategory productShowing
Route::get('/products/{id}', 'ProductController@productsView');
//---------Order Tracking----------
Route::post('order/tracking', 'FrontController@OrderTracking')->name('order.tracking');
//---------UserOrderView-----------
Route::get('user/view/order/{id}', 'FrontController@UserOrderView');
//----------Search-----------
Route::post('product/search', 'FrontController@ProductSearch')->name('product.search');




