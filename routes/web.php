<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get ( '/', function () {
	return view ( 'welcome' );
} );

//Route::get('/','UserdeleteController@delete');

Route::get ( '/Menu', function () {
	return view ( 'Menu' );
} );

	//Route::get ( '/hello_world/index', 'HelloWorldController@getIndex' );
	//Route::get ( '/hello_world/login', 'HelloWorldController@getLogin' );

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/users','UserController@index');
	Route::get('/ajax/{deletecode}','UserdeleteController@delete');
	//Route::get('/useradd','UseraddController@add');
	//Route::post('/useradd','UseraddController@insert');

