<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\GameUser;

class GameUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $gameUsers = GameUser::all();
        $params = [
            'title' => 'Game Users Listing',
            'gameUsers' => $gameUsers
        ];
        return view('admin.gameUsers.gameUsers_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.gameUsers.gameUsers_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return redirect()->route('gameUsers.index')->with('success', "The game <strong>Game</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $gameUser = GameUser::find($id);
        $params = [
            'title' => 'Delete User',
            'gameUser' => $gameUser
        ];
        return view('admin.gameUsers.gameUsers_delete')->with($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.gameUsers.gameUsers_edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('gameUsers.index')->with('success', "The game <strong>Game</strong> has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        return redirect()->route('gameUsers.index')->with('success', "The game <strong>Game</strong> has successfully been archived.");
    }
}
