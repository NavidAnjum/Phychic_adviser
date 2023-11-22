<?php

Route::post('/register', [\App\Http\Controllers\Auth\ApiAuth::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\ApiAuth::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    //changing pass of user
     Route::post('/change_password', [\App\Http\Controllers\Auth\ApiAuth::class, 'changePassword'])->name('changePassword');

   //  fetching the currently authenticated user
     Route::get('/get_auth_user', [\App\Http\Controllers\Auth\ApiAuth::class, 'currentUser']);

});
