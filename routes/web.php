<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::resource('games', 'GamesController');
    Route::resource('gameUsers', 'GameUsersController');
    Route::resource('gameResults', 'GameResultsController');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Auth::routes();
});
