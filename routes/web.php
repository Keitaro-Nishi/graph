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

Auth::routes ();
Route::get ( '/register', 'Auth\RegisterController@showRegistrationForm' )->name('register')->middleware('role');

Route::get ( '/home', 'HomeController@index' )->name ( 'home' )->middleware('auth');

Route::get ( '/users', 'UserController@index' )->name ( 'users' )->middleware('auth');
Route::get ( '/users/{deletecode}', 'UserController@delete' );

Route::get ( '/botlog', 'BotlogController@index' )->name ( 'botlog' )->middleware('auth');

Route::get ( '/opinion', 'OpinionController@index' )->name ( 'opinion' )->middleware('auth');
Route::get ( '/opinion/{deleteno}','OpinionController@delete' );

Route::get ( '/logindata', 'LogindataController@index' )->name ( 'logindata' )->middleware('role');
