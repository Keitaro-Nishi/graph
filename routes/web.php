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

//Route::get('/','LoginController@index');

Route::get ( '/Menu', function () {
	return view ( 'Menu' );
} );

	//Route::get ( '/hello_world/index', 'HelloWorldController@getIndex' );
	//Route::get ( '/hello_world/login', 'HelloWorldController@getLogin' );

	Auth::routes();

	//Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/Custinfo','CustinfoController@index');
	Route::get('/ajax/{deletecode}','CustinfodeleteController@delete');
	Route::get('/Custinfoadd','CustinfoaddController@add');
	Route::post('/Custinfoadd','CustinfoaddController@insert');
	//Route::get('/login','LoginController@index');
	//Route::post('/login','LoginController@login');
