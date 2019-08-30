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
Route::get('/games/{game_id}/results', 'ApiController@getResults');
Route::get('/games/{game_id}/result', 'ApiController@getResult');
