<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Auth;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\GameUser;

class GameUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $game_id
     * @return Response
     */
    public function index($game_id)
    {
        $game = Game::findOrFail($game_id);
        $game_users = $game->users;

        $params = [
            'game_users' => $game_users,
            'game' => $game
        ];

        return view('admin.gameUsers.index')->with($params);
    }

    public function games($game_user_id) {
        $game_user = GameUser::findOrFail($game_user_id);
        $games = [];
        foreach ($game_user->games as $game) {
            if($game->owner->id == auth()->user()->id) {
                array_push($games, $game);
            }
        }

        $params = [
            'title' => 'List games played',
            'game_user' => $game_user,
            'games' => $games,
        ];

        return view('admin.games.index')->with($params);
    }

    /**
     * Display the specified resource.
     *
     * @param $game_id
     * @param $game_user_id
     * @return Response
     */
    public function show($game_id, $game_user_id)
    {
        $game_user = GameUser::findOrFail($game_user_id);
        $game = Game::findOrFail($game_id);
        $params = [
            'game_user' => $game_user,
            'game' => $game
        ];
        return view('admin.gameUsers.show')->with($params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $game_id
     * @param $game_user_id
     * @return Response
     */
    public function destroy($game_id, $game_user_id)
    {
        $game_user = GameUser::findOrFail($game_user_id);
        if (!$game_user) {
            return redirect()
                ->route('admin.gameUsers.index')
                ->withFlashDanger('The game user you requested for has not been found.');
        }
        $game_user->delete();
        return redirect()->route('admin.gameUsers.index', [$game_id])->withFlashSuccess("The user has successfully been archived.");
    }
}
