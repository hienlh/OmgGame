<?php

namespace OmgGame\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use OmgGame\Models\ExtraInfo;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;
use OmgGame\Models\GameUser;
use OmgGame\Models\InfoForm;
use OmgGame\Models\InfoFormType;
use OmgGame\Models\Operator;
use OmgGame\Models\User;
use Psr\Http\Message\ResponseInterface;

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

    public function updateExtraInfo(Request $request)
    {
        $game_user = $this->saveUserInfo($request);
        if ($game_user == null) return response()->json('Missing info: id, name or avatar', 403);

        $info_forms = [];

        foreach (InfoForm::all() as $info_form) {
            $info_forms[$info_form->key] = 1;
        }

        foreach ($request->input() as $key => $data) {
            if (isset($info_forms[$key])) {
                DB::table('extra_infos')
                    ->updateOrInsert(
                        ['game_user_id' => $request->input('id'), 'key' => $key],
                        ['value' => $data]
                    );
            }
        }
        return response()->json('Update extra info success', 200);
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

    /**
     * @param Request $request id,name,avatar
     * @param $game_id
     * @return ResponseInterface|string
     */
    public function getResult(Request $request, $game_id)
    {
        $this->saveUserPlayGame($request, $game_id);

        $extra_infos = [];
        foreach (ExtraInfo::all()->where('game_user_id', $request->id) as $info) {
            $extra_infos[$info->key] = $info->value;
        }

        foreach (Game::findOrFail($game_id)->info_forms as $info_form) {
            if (!isset($extra_infos[$info_form->key]))
                return response()->json("Missing info \"" . $info_form->name . "\"", 403);
        }

        $random_list = [];
        $results = GameResult::all()
            ->where('game_id', $game_id)
            ->where('delete_at', null);

        foreach ($results as $result) {
            $conditions = $result->conditions;
            $correct_condition = true;
            foreach ($conditions as $condition) {
                if(!isset($extra_infos[$condition->key])) {
                    $correct_condition = false;
                    break;
                }
                $date1 = DateTime::createFromFormat('d/m/Y', $extra_infos[$condition->key]);
                $date2 = DateTime::createFromFormat('d/m/Y', $condition->condition);
                if ($condition->info_form->type == InfoFormType::$datePicker && $date1 && $date2) {
                    if (!Operator::handle($date1, $date2, $condition->operator)) {
                        $correct_condition = false;
                        break;
                    }
                }
                // Comment because php can compare 2 string like number if those string can convert to number, we don't need to convert as well
                //                else if (is_numeric($extra_infos[$condition->key]) && is_numeric($condition->condition)) {
                //                    if (!Operator::handle($extra_infos[$condition->key] + 0, $condition->condition + 0, $condition->operator)) {
                //                        $correct_condition = false;
                //                        break;
                //                    }
                //                }
                else if (!Operator::handle($extra_infos[$condition->key], $condition->condition, $condition->operator)) {
                    $correct_condition = false;
                    break;
                }
            }
            if ($correct_condition) {
                array_push($random_list, $result);
            }
        }

        if (count($random_list) <= 0) return "";
        $index = array_rand($random_list);
        $image_url = $random_list[$index]->image;

        return $this->renderImageResult($random_list[$index]->design, $image_url, $request->avatar, $request->name);
    }

    protected function renderImageResult($design, $background, $avatar, $name)
    {
        $client = new Client();
        try {
            return $client->post('https://omg-support-server.herokuapp.com', [
                'form_params' => [
                    'json' => $design,
                    'background' => $background,
                    'avatar' => $avatar,
                    'name' => $name
                ]
            ]);
        } catch (GuzzleException $e) {
            return "";
        }
    }

    public function getInfoForms(Request $request, $game_id)
    {
        $this->saveUserPlayGame($request, $game_id);

        $extra_infos = [];
        foreach (ExtraInfo::all()->where('game_user_id', $request->id) as $info) {
            $extra_infos[$info->key] = $info->value;
        }

        $result = [];
        foreach (Game::findOrFail($game_id)->info_forms as $info_form) {
            if (!isset($extra_infos[$info_form->key]))
                array_push($result, $info_form);
        }

        return $result;
    }

    protected function saveUserInfo(Request $request)
    {
        if (isset($request->id) && isset($request->name) && isset($request->avatar)) {
            DB::table('game_users')
                ->updateOrInsert(
                    ['id' => $request->id],
                    ['name' => $request->name, 'avatar' => $request->avatar, 'last_play' => Carbon::now()]
                );
            return GameUser::find($request->id);
        }
        return null;
    }

    protected function saveUserPlayGame(Request $request, $game_id)
    {
        if (isset($request->id) && isset($request->name) && isset($request->avatar)) {
            $game_user = $this->saveUserInfo($request);
            if (!$game_user->games->contains($game_id))
                $game_user->games()->attach($game_id);
            return $game_user;
        }
        return null;
    }

    protected function getBanners($user_id) {
        $user = User::findOrFail($user_id);

        return [
            "top_banner" => $user->top_banner,
            "bottom_banner" => $user->bottom_banner,
        ];
    }

    public function test($game_id)
    {
        return Game::findOrFail($game_id)->info_forms;
    }
}
