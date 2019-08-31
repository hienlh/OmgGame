<?php

namespace OmgGame\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;
use Psy\Util\Json;

class ApiController extends Controller
{
    public function getGames(Request $request, $user_id) {
        return Game::all()
            ->where('user_id', $user_id)
            ->where('is_active', 1)
            ->where('delete_at', null);
    }

    public function getResults(Request $request, $game_id) {
        return GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
    }

    public function getResult(Request $request, $game_id) {
        $result = GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
        return $result[array_rand($result)];
    }
}
