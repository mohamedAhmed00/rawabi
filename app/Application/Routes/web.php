<?php

Route::group(['middleware' => 'web'], function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::group(['namespace' => 'Auth'], function () {
            Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
            Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);
        });
        Route::group(['middleware' => 'auth'], function () {
            Route::get('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
            Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
            Route::group(['prefix' => 'site-info'], function () {
                Route::get('/', ['as' => 'admin.settings', 'uses' => 'SettingController@index']);
                Route::post('/', ['as' => 'admin.settings', 'uses' => 'SettingController@store']);
            });
            Route::group(['prefix' => 'homePage'], function () {
                Route::get('/sections', ['as' => 'admin.sections', 'uses' => 'HomeSectionController@index']);
                Route::post('/sections/edit/{id}', ['as' => 'admin.sections.edit', 'uses' => 'HomeSectionController@update']);
            });
            Route::group(['prefix' => 'features'], function () {
                Route::get('/', ['as' => 'admin.features', 'uses' => 'FeatureController@index']);
                Route::post('/edit/{id}', ['as' => 'admin.features.edit', 'uses' => 'FeatureController@update']);
            });
            Route::group(['prefix' => 'about-us'], function () {
                Route::get('/', ['as' => 'admin.about', 'uses' => 'AboutController@index']);
                Route::post('/', ['as' => 'admin.about', 'uses' => 'AboutController@store']);
            });
            Route::group(['prefix' => 'testimonials'], function () {
                Route::get('/', ['as' => 'admin.testimonials', 'uses' => 'TestimonialController@index']);
                Route::post('/', ['as' => 'admin.testimonials', 'uses' => 'TestimonialController@store']);
                Route::get('/info/{id}', ['as' => 'admin.testimonials.info', 'uses' => 'TestimonialController@edit']);
                Route::post('/edit/{id}', ['as' => 'admin.testimonials.edit', 'uses' => 'TestimonialController@update']);
                Route::get('/delete/{id}', ['as' => 'admin.testimonials.delete', 'uses' => 'TestimonialController@delete']);
            });
            Route::group(['prefix' => 'cities'], function () {
                Route::get('/', ['as' => 'admin.cities', 'uses' => 'CityController@index']);
                Route::post('/', ['as' => 'admin.cities', 'uses' => 'CityController@store']);
                Route::get('/info/{id}', ['as' => 'admin.cities.info', 'uses' => 'CityController@edit']);
                Route::post('/edit/{id}', ['as' => 'admin.cities.edit', 'uses' => 'CityController@update']);
                Route::get('/delete/{id}', ['as' => 'admin.cities.delete', 'uses' => 'CityController@delete']);
            });
            Route::group(['prefix' => 'products'], function () {
                Route::get('/', ['as' => 'admin.products', 'uses' => 'ProductController@index']);
                Route::post('/', ['as' => 'admin.products', 'uses' => 'ProductController@store']);
                Route::get('/info/{product}', ['as' => 'admin.products.info', 'uses' => 'ProductController@edit']);
                Route::post('/edit/{product}', ['as' => 'admin.products.edit', 'uses' => 'ProductController@update']);
                Route::get('/delete/{product}', ['as' => 'admin.products.delete', 'uses' => 'ProductController@delete']);
                Route::group(['prefix' => 'types'], function () {
                    Route::get('/{id}', ['as' => 'admin.products.categories', 'uses' => 'ProductCategoryController@index']);
                    Route::post('/{id}', ['as' => 'admin.products.categories', 'uses' => 'ProductCategoryController@store']);
                    Route::get('/info/{id}', ['as' => 'admin.products.categories.info', 'uses' => 'ProductCategoryController@edit']);
                    Route::post('/edit/{id}', ['as' => 'admin.products.categories.edit', 'uses' => 'ProductCategoryController@update']);
                    Route::get('/delete/{id}', ['as' => 'admin.products.categories.delete', 'uses' => 'ProductCategoryController@delete']);
                });
            });
            Route::group(['prefix' => 'sliders'], function () {
                Route::get('/', ['as' => 'admin.sliders', 'uses' => 'SliderController@index']);
                Route::post('/', ['as' => 'admin.sliders', 'uses' => 'SliderController@store']);
                Route::get('/info/{slider}', ['as' => 'admin.sliders.info', 'uses' => 'SliderController@edit']);
                Route::post('/edit/{slider}', ['as' => 'admin.sliders.edit', 'uses' => 'SliderController@update']);
                Route::get('/delete/{slider}', ['as' => 'admin.sliders.delete', 'uses' => 'SliderController@delete']);
            });
            Route::group(['prefix' => 'order_status'], function () {
                Route::get('/', ['as' => 'admin.order_status', 'uses' => 'OrderStatusController@index']);
                Route::post('/', ['as' => 'admin.order_status', 'uses' => 'OrderStatusController@store']);
                Route::get('/info/{order_status}', ['as' => 'admin.order_status.info', 'uses' => 'OrderStatusController@edit']);
                Route::post('/edit/{order_status}', ['as' => 'admin.order_status.edit', 'uses' => 'OrderStatusController@update']);
                Route::get('/delete/{order_status}', ['as' => 'admin.order_status.delete', 'uses' => 'OrderStatusController@delete']);
            });
            Route::group(['prefix' => 'checkouts'], function () {
                Route::get('/', ['as' => 'admin.checkout', 'uses' => 'CheckoutController@index']);
                Route::get('/order/{id}', ['as' => 'admin.checkout.single', 'uses' => 'CheckoutController@show']);
                Route::post('/order/history/{id}', ['as' => 'admin.checkouts.order.history', 'uses' => 'CheckoutController@addHistory']);
                Route::get('/order/invoice/{id}', ['as' => 'admin.checkout.invoice', 'uses' => 'CheckoutController@invoice']);
                Route::get('/order/invoice/download/{id}', ['as' => 'admin.checkout.invoice.download', 'uses' => 'CheckoutController@downloadInvoice']);
                Route::get('/delete/{id}', ['as' => 'admin.checkout.delete', 'uses' => 'CheckoutController@delete']);
            });
            Route::get('/subscribers', ['as' => 'admin.subscribers', 'uses' => 'SubscriberController@index']);
            Route::get('/subscribers/delete/{id}', ['as' => 'admin.subscribers.delete', 'uses' => 'SubscriberController@delete']);
            Route::get('/messages', ['as' => 'admin.messages', 'uses' => 'MessageController@index']);
            Route::get('/messages/delete/{id}', ['as' => 'admin.messages.delete', 'uses' => 'MessageController@delete']);
        });
    });
    Route::group(['namespace' => 'Site'], function () {
        Route::get('/', ['as' => 'site.index', 'uses' => 'HomeController@index']);
        Route::post('subscribe', ['as' => 'site.subscribe', 'uses' => 'HomeController@storeSubscribe']);
        Route::get('/about-us', ['as' => 'site.about', 'uses' => 'AboutController@index']);
        Route::get('/orders', ['as' => 'site.orders', 'uses' => 'OrderController@index']);
        Route::get('/order/{product}', ['as' => 'site.orders.single', 'uses' => 'OrderController@show']);
        Route::get('/contact-us', ['as' => 'site.contact', 'uses' => 'ContactController@index']);
        Route::post('/contact-us', ['as' => 'site.contact', 'uses' => 'ContactController@store']);
        Route::get('/cart', ['as' => 'site.cart', 'uses' => 'CartController@index']);
        Route::post('/cart/{product}', ['as' => 'site.cart.add', 'uses' => 'CartController@store']);
        Route::post('/cart/edit/{rowId}', ['as' => 'site.cart.update', 'uses' => 'CartController@update']);
        Route::get('/delete/{id}', ['as' => 'site.cart.remove', 'uses' => 'CartController@delete']);
        Route::get('/checkout', ['as' => 'site.checkout', 'uses' => 'CheckoutController@index']);
        Route::post('/checkout', ['as' => 'site.checkout', 'uses' => 'CheckoutController@store']);
    });
});
