<?php
Route::get('/ping' , ['as' => 'api.products' ,'uses' => 'Api\ApiManagementController@ping'])->middleware(['cors','throttle:20,1']);
Route::group(['middleware' => ['auth:sanctum','cors','throttle:20,1']], function () {
    Route::get('/products' ,'Api\ProductController@getProducts');
    Route::get('/product/{slug}' , 'Api\ProductController@getProduct');
    Route::get('/sliders' , 'Api\UtilityController@getSliders');
    Route::get('/cities' , 'Api\UtilityController@getCities');
    Route::get('/settings' , 'Api\UtilityController@getSettings');
    Route::post('/contact' , 'Api\UtilityController@contacts');
    Route::post('/subscribe' , 'Api\UtilityController@subscribe');
    Route::get('/cart' , 'Api\CartController@index');
    Route::post('/cart/{slug}' , 'Api\CartController@store');
    Route::patch('/cart/{key}' , 'Api\CartController@update');
    Route::delete('/cart/{key}' , 'Api\CartController@delete');
    Route::delete('/clear/cart' , 'Api\CartController@clear');
    Route::post('/checkout', 'Api\CheckoutController@store');

});
