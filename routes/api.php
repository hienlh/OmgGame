<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OmgGame\Models\Game;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{user_id}/games', 'ApiController@getGames');
Route::post('/users/{user_id}/games', 'ApiController@getGamesWithUser');
Route::post('/extra_info', 'ApiController@updateExtraInfo');
Route::get('/games/{game_id}/results', 'ApiController@getResults');
Route::post('/games/{game_id}/result', 'ApiController@getResult');
Route::post('/games/{game_id}/info_forms', 'ApiController@getInfoForms');
Route::get('/banners/{user_id}', 'ApiController@getBanners');
Route::get('/test/{game_id}', 'ApiController@test');
