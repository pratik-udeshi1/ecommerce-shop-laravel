<?php

/////////////////////////////////////////////////////
// Authentication & Authorization sidecar starts.. //
/////////////////////////////////////////////////////
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('register', 'Api\Auth\LoginController@register');
Route::get('refresh-token', 'Api\Controller@refreshToken');
///////////////////////////////////////////////////
// Authentication & Authorization sidecar ends.. //
///////////////////////////////////////////////////

Route::group(['middleware' => 'JwtAuthorizer', 'prefix' => 'user'], function () {
    Route::get('all', 'Api\UserController@index');
});

Route::group(['middleware' => 'JwtAuthorizer'], function () {
    Route::resource('shop', 'Api\ShopController');
});
