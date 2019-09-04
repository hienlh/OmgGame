<?php

namespace OmgGame\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;
use function MongoDB\BSON\toJSON;

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
        $design_json = json_decode($result[$index]->design);

        $all_objs = $design_json->children[0]->children;
        $background_obj = null;
        $avatar_obj = null;
        $name_obj = null;
        $text_list_objs = [];
        foreach ($all_objs as $obj) {
            if (isset($obj->attrs->id) && $obj->attrs->id == 'background') {
                $background_obj = $obj->attrs;
            } else if (isset($obj->attrs->id) && $obj->attrs->id == 'avatar') {
                $avatar_obj = $obj->attrs;
            } else if (isset($obj->attrs->id) && $obj->attrs->id == 'name') {
                $name_obj = $obj->attrs;
            } else if (isset($obj->className) && $obj->className == 'Text') {
                array_push($text_list_objs, $obj->attrs);
            }
        }

        // Render background
        $image = Image::make($image_url)->resize($background_obj->width, $background_obj->height);

        // Render avatar
        $avatar_image = Image::make($request->avatar)->resize(
            (isset($avatar_obj->width) ? $avatar_obj->width : 200) * (isset($avatar_obj->scaleX) ? $avatar_obj->scaleX : 1),
            (isset($avatar_obj->height) ? $avatar_obj->height : 200) * (isset($avatar_obj->scaleY) ? $avatar_obj->scaleY : 1));
        $image = $image->insert($avatar_image, 'top-left', isset($avatar_obj->x) ? (int)$avatar_obj->x : 0,
            isset($avatar_obj->y) ? (int)$avatar_obj->y : 0);

        // Render name
        $image->text($request->name,
            isset($name_obj->x) ? (int)($name_obj->x + $name_obj->width / 2) : 0,
            isset($name_obj->y) ? (int)$name_obj->y : 0,
            function ($font) {
                $font->file(public_path('admin/fonts/arial.ttf'));
                $font->size(isset($text_obj->fontSize) ? $text_obj->fontSize : 20);
                $font->align('center');
            });

        // Render other text
        foreach ($text_list_objs as $text_obj) {
            $image->text(isset($text_obj->text) ? $text_obj->text : '',
                isset($text_obj->x) ? (int)($text_obj->x + $text_obj->width / 2) : 0,
                isset($text_obj->y) ? (int)$text_obj->y : 0, function ($font) {
                    $font->file(public_path('admin/fonts/arial.ttf'));
                    $font->size(isset($text_obj->fontSize) ? $text_obj->fontSize : 20);
                });
        }

        return $image->response();
//        return public_path('admin/fonts/arial.ttf');
    }

    public function test()
    {
        $image = Image::make('admin/images/img.jpg')->resize(300, 200);
        return $image->response();
    }
}
