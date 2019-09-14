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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/fb-login', function (Request $request) {
    return view('fb_login')->with(['id' => $request->query('id')]);
});
Route::get('/auth/redirect/{provider}/{id}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::resource('games', 'GamesController');
    Route::get('all-games', 'AllGamesController@index')->name('all-games.index');
    Route::resource('users', 'UsersController')->except('create');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('info_forms', 'InfoFormsController');

    // Game result routes
    Route::get('/games/{game_id}/results', 'GameResultsController@index')->name('gameResults.index');
    Route::get('/games/{game_id}/results/create', 'GameResultsController@create')->name('gameResults.create');
    Route::post('/games/{game_id}/results', 'GameResultsController@store')->name('gameResults.store');
    Route::get('/games/{game_id}/results/{result_id}/edit', 'GameResultsController@edit')->name('gameResults.edit');
    Route::put('/games/{game_id}/results/{result_id}', 'GameResultsController@update')->name('gameResults.update');
    Route::get('/games/{game_id}/results/{result_id}', 'GameResultsController@show')->name('gameResults.destroy');
    Route::delete('/games/{game_id}/results/{result_id}', 'GameResultsController@destroy')->name('gameResults.destroy');

    // Game user routes
    Route::get('/games/{game_id}/users', 'GameUsersController@index')->name('gameUsers.index');
    Route::get('/games/{game_id}/users/{game_user_id}', 'GameUsersController@show')->name('gameUsers.destroy');
    Route::delete('/games/{game_id}/users/{game_user_id}', 'GameUsersController@destroy')->name('gameUsers.destroy');
    Route::get('/gameUsers/{game_user_id}/games', 'GameUsersController@games')->name('gameUsers.games');

    // Game result condition
    Route::get('/game_results/{result_id}/conditions', 'ResultConditionsController@index')->name('conditions.index');
    Route::get('/game_results/{result_id}/conditions/create', 'ResultConditionsController@create')->name('conditions.create');
    Route::post('/game_results/{result_id}/conditions', 'ResultConditionsController@store')->name('conditions.store');
    Route::get('/game_results/{result_id}/conditions/{id}/edit', 'ResultConditionsController@edit')->name('conditions.edit');
    Route::put('/game_results/{result_id}/conditions/{id}', 'ResultConditionsController@update')->name('conditions.update');
    Route::get('/game_results/{result_id}/conditions/{id}/show', 'ResultConditionsController@show')->name('conditions.show');
    Route::delete('/game_results/{result_id}/conditions/{id}', 'ResultConditionsController@destroy')->name('conditions.destroy');

    // Extra info
    Route::get('/game_users/{game_user_id}/extra_infos', 'ExtraInfosController@index')->name('extraInfos.index');
    Route::get('/game_users/{game_user_id}/extra_infos/{id}', 'ExtraInfosController@show')->name('extraInfos.show');
    Route::delete('/game_users/{game_user_id}/extra_infos/{id}', 'ExtraInfosController@destroy')->name('extraInfos.destroy');

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Auth::routes();
});
