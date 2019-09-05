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
})->name('welcome');

Route::get('/fb-login', function () {
    return view('fb_login');
});
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::resource('games', 'GamesController');
    Route::get('all-games', 'AllGamesController@index')->name('all-games.index');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::get('/games/{game_id}/results', 'GameResultsController@index')->name('gameResults.index');
    Route::get('/games/{game_id}/results/create', 'GameResultsController@create')->name('gameResults.create');
    Route::post('/games/{game_id}/results', 'GameResultsController@store')->name('gameResults.store');
    Route::get('/games/{game_id}/results/{result_id}/edit', 'GameResultsController@edit')->name('gameResults.edit');
    Route::put('/games/{game_id}/results/{result_id}', 'GameResultsController@update')->name('gameResults.update');
    Route::get('/games/{game_id}/results/{result_id}', 'GameResultsController@show')->name('gameResults.destroy');
    Route::delete('/games/{game_id}/results/{result_id}', 'GameResultsController@destroy')->name('gameResults.destroy');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Auth::routes();
});
