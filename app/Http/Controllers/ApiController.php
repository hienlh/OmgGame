<?php

namespace OmgGame\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;
use OmgGame\Models\GameUser;
use OmgGame\Models\InfoForm;

class ApiController extends Controller
{
    public function getGames(Request $request, $user_id)
    {
        $this->saveUserInfo($request);
        return Game::all()
            ->where('user_id', $user_id)
            ->where('is_active', 1)
            ->where('delete_at', null);
    }

    public function getGamesWithUser(Request $request, $user_id)
    {
        $this->saveUserInfo($request);
        return Game::all()
            ->where('user_id', $user_id)
            ->where('is_active', 1)
            ->where('delete_at', null);
    }

    public function getResults(Request $request, $game_id)
    {
        $this->saveUserInfo($request);
        return GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
    }

    public function getResult(Request $request, $game_id)
    {
        $this->saveUserPlayGame($request, $game_id);
        $result = GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);
        $index = array_rand($result->toArray());
        $image_url = $result[$index]->image;
        $client = new Client();
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

    public function getInfoForms(Request $request, $game_id) {
        $this->saveUserPlayGame($request, $game_id);
        return InfoForm::all()->where('game_id', $game_id);
    }

    protected function saveUserInfo(Request $request) {
        if (isset($request->id) && isset($request->name) && isset($request->avatar)) {
            $game_user = GameUser::find($request->id);
            if (!isset($game_user)) {
                $game_user = new GameUser();
                $game_user->id = $request->id;
            }
            $game_user->name = $request->name;
            $game_user->avatar = $request->avatar;
            $game_user->last_play = Carbon::now();
            $game_user->save();
        }
    }

    protected function saveUserPlayGame(Request $request, $game_id) {
        if (isset($request->id) && isset($request->name) && isset($request->avatar)) {
            $game_user = GameUser::find($request->id);
            if (!isset($game_user)) {
                $game_user = new GameUser();
                $game_user->id = $request->id;
            }
            $game_user->name = $request->name;
            $game_user->avatar = $request->avatar;
            $game_user->last_play = Carbon::now();
            $game_user->save();
            $game_user = GameUser::find($request->id);
            if(!$game_user->games->contains($game_id))
                $game_user->games()->attach($game_id);
        }
    }

    public function test()
    {
        $image = Image::make('admin/images/img.jpg')->resize(300, 200);
        return $image->response();
    }
}
