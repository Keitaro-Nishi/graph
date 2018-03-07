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
	return redirect ( '/login' );
} );

Auth::routes ();

Route::middleware(['auth'])->group(function () {
	Route::get ( '/register', 'Auth\RegisterController@showRegistrationForm' )->name ( 'register' )->middleware ( 'role' );

	Route::get ( '/home', 'HomeController@index' )->name ( 'home' );

	Route::get ( '/users', 'UserController@index' )->name ( 'users' );
	Route::get ( '/users/{deletecode}', 'UserController@delete' );

	Route::get ( '/opinion', 'OpinionController@index' )->name ( 'opinion' );
	Route::post ( '/opinion', 'OpinionController@request' );

	Route::get ( '/botlog', 'BotlogController@index' )->name ( 'botlog' );
	Route::post ( '/botlog', 'BotlogController@request' );

	Route::get ( '/logimage', 'LogimageController@index' )->name ( 'logimage' );
	Route::get ( '/logimage/{deleteno}', 'LogimageController@delete' );

	Route::get ( '/facility', 'FacilityController@index' )->name ( 'facility' );
	Route::post ( '/facility', 'FacilityController@request' );

	Route::get ( '/genre', 'GenreController@index' )->name ( 'genre' );
	Route::get ( '/genreinit', 'GenreController@init' )->name ( 'genreinit' );

	Route::get ( '/linepush', function () {
		return view ( 'linepush' );
	} )->name ( 'linepush' );

	Route::get ( '/codemanage', 'CodeManageController@index' )->name ( 'codemanage' )->middleware ( 'role' );

	Route::get ( '/logindata', 'LogindataController@index' )->name ( 'logindata' )->middleware ( 'role' );
} );
