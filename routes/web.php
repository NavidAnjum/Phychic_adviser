<?php

use App\Http\Controllers\HomeController;
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

Route::get('/{any}', [\App\Http\Controllers\SpaController::class ,'index'])->where('any', '.*');

//Route::group(['namespace' => 'App\Http\Controllers'], function()
//{
    /**
     * Home Routes
     */
    //Route::get('/', [HomeController::class ,'index'])->name('home.index');

//    Route::group(['middleware' => ['guest']], function() {
//        /**
//         * Register.vue Routes
//         */
//        Route::get('/register', 'RegisterController@show')->name('register.show');
//
//        /**
//         * Login Routes
//         */
//        Route::get('/login', 'LoginController@show')->name('login.show');
//
//    });


//});
