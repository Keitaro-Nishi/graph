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

Route::get('/', function () { return redirect('/login'); });

Route::get ( '/Menu', function () {
	return view ( 'Menu' );
} );

Auth::routes ();
Route::get ( '/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('role');

Route::get ( '/home', 'HomeController@index' )->name ( 'home' );
Route::get ( '/users', 'UserController@index' );
//Route::get ( '/ajax/{deletecode}', 'UserController@delete' );
Route::get ( '/logindata', 'LogindataController@index' );
Route::get ( '/jqgrid', 'jqgridController@index' );
Route::get ( '/opinion', 'OpinionController@index' );
Route::get ( '/ajax/{deleteopinion}', 'OpinionController@delete');
	//Route::get('/ajax/{deletecode}','UserdeleteController@delete');
	//Route::get('/useradd','UseraddController@add');
	//Route::post('/useradd','UseraddController@insert');