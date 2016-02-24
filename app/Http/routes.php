<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontController@listProducts');

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::resource(
        'cart',
        'CartController',
        ['only' => ['index', 'store', 'update', 'destroy']]
    );
});
