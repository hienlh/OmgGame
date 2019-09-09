<?php

namespace OmgGame\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;

class ApiController extends Controller
{
    public function getGames(Request $request, $user_id)
    {
        return Game::all()
            ->where('user_id', $user_id)
            ->where('is_active', 1)
            ->where('delete_at', null);
    }

    public function getResults(Request $request, $game_id)
    {
        return GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
    }

    public function getResult(Request $request, $game_id)
    {
        $result = GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
        $index = array_rand($result->toArray());
        $image_url = $result[$index]->image;
         $client= new Client();
        try {
            return $client->post('https://omg-support-server.herokuapp.com', [
                'form_params' => [
                    'json' => $result[$index]->design,
                    'background' => $image_url,
                    'avatar' => $request->avatar,
                    'name' => $request->name
                ]
            ]);
        } catch (GuzzleException $e) {
            return $game_id;
        }
    }

    public function test()
    {
        $image = Image::make('admin/images/img.jpg')->resize(300, 200);
        return $image->response();
    }
}
