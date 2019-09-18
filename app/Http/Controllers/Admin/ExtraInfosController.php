<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\ExtraInfo;
use OmgGame\Models\GameUser;

class ExtraInfosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $game_user_id
     * @return Response
     */
    public function index($game_user_id)
    {
        $game_user = GameUser::findOrFail($game_user_id);
        $infos = ExtraInfo::where('game_user_id', $game_user_id)->paginate();

        $params = [
            'game_user' => $game_user,
            'infos' => $infos
        ];

        return view('admin.extraInfos.index')->with($params);
    }

    /**
     * Display the specified resource.
     *
     * @param $game_user_id
     * @param int $id
     * @return Response
     */
    public function show($game_user_id, $id)
    {
        $game_user = GameUser::find($game_user_id);
        if (!isset($game_user)) return redirect()->back()->with('flash_warning', 'User not found');
        $info = ExtraInfo::where('game_user_id', $game_user_id)->where('key', $id)->first();
        if (!isset($info)) return redirect()->back()->with('flash_warning', 'Info not found');
        $params = [
            'game_user' => $game_user,
            'info' => $info
        ];
        return view('admin.extraInfos.show')->with($params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($game_user_id, $id)
    {
        $game_user = GameUser::find($game_user_id);
        if (!isset($game_user)) return redirect()->back()->with('flash_warning', 'User not found');
        $info = ExtraInfo::where('game_user_id', $game_user_id)->where('key', $id)->first();
        if (!isset($info)) return redirect()->back()->with('flash_warning', 'Info not found');
        DB::table('extra_infos')->where('game_user_id', $game_user_id)->where('key', $id)->delete();
        return redirect()->route('admin.extraInfos.index', [$game_user_id])->withFlashSuccess("The info has successfully been archived.");
    }
}
