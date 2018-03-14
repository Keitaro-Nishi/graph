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
	Route::get ( '/register', 'Auth\RegisterController@showRegistrationForm' )->name('register')->middleware('role');

	Route::get ( '/home', 'HomeController@index' )->name ( 'home' );

	//Route::get ( '/users', 'UserController@index' )->name ( 'users' )->middleware('role');
	//Route::post ( '/users', 'UserController@request' )->middleware('role');
	Route::get ( '/users', 'UserController@index' )->name ( 'users' );
	Route::post ( '/users', 'UserController@request' );

	Route::get ( '/opinion', 'OpinionController@index' )->name ( 'opinion' );
	Route::post ( '/opinion', 'OpinionController@request' );

	Route::get ( '/botlog', 'BotlogController@index' )->name ( 'botlog' );
	Route::get ( '/botlog/{deleteno}','BotlogController@delete' );

	Route::get ( '/logimage', 'LogimageController@index' )->name ( 'logimage' );
	Route::get ( '/logimage/{deleteno}','LogimageController@delete' );

	Route::get ( '/facility', 'FacilityController@index' )->name ( 'facility' );
	Route::post ( '/facility', 'FacilityController@update' );


	Route::get ( '/genre', 'GenreController@index' )->name ( 'genre' );
	Route::post ( '/genre','GenreController@request');

	Route::get ( '/genreint', 'GenreintController@index' )->name ( 'genreint' );
	Route::post ( '/genreint', 'GenreintController@request' );

	Route::get ( '/genreent', 'GenreentController@index' )->name ( 'genreent' );
	Route::post ( '/genreent', 'GenreentController@request' );

	Route::get ( '/linepush',function(){
		return view( 'linepush' );
	})->name ( 'linepush' );

	Route::get ( '/logindata', 'LogindataController@index' )->name ( 'logindata' )->middleware('role');
	Route::post ( '/logindata', 'LogindataController@request' );

	//Route::get ( '/codemanage', 'CodeManageController@index')->name('codemanage')->middleware('role');
	//Route::post ( '/codemanage', 'CodeManageController@request')->name('codemanage')->middleware('role');
	Route::get ( '/codemanage', 'CodeManageController@index')->name('codemanage');
	Route::post ( '/codemanage', 'CodeManageController@request');


	Route::get ( '/parameter', 'ParameterController@index')->name('parameter');
	Route::post ( '/parameter', 'ParameterController@request');

	Route::get ( '/messagemanage', 'MessageManageController@index')->name('messagemanage');
	Route::post ( '/messagemanage', 'MessageManageController@request');

});
