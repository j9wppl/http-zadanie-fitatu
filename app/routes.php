<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('products');
});


Route::group(['namespace' => 'Fitatu\Controllers'], function () {
	Route::get('products', ['as' => 'products', 'uses' => 'ProductController@index']);
	Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@index']);
	Route::get('addToCart/{id}', ['as' => 'add-to-cart', 'uses' => 'CartController@add']);
	Route::get('decrementItem/{id}', ['as' => 'decrement-item', 'uses' => 'CartController@decrementItem']);

	Route::delete('removeFromCart/{id}', ['as' => 'remove-from-cart', 'uses' => 'CartController@remove']);
});