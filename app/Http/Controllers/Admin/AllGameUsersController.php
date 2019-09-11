<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Response;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\GameUser;

class AllGameUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $game_id
     * @return Response
     */
    public function index($game_id)
    {
        $game_users = GameUser::all();
        $game = Game::findOrFail($game_id);

        $params = [
            'game_users' => $game_users,
            'game' => $game
        ];

        return view('admin.gameUsers.index')->with($params);
    }
}
