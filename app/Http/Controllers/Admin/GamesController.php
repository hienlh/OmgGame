<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\User;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $games = Game::all();

        $params = [
            'title' => 'Games Listing',
            'games' => $games,
        ];

        return view('admin.games.games_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all();

        $params = [
            'title' => 'Create Game',
            'users' => $users
        ];

        return view('admin.games.games_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'is_active' => 'required',
            'name' => 'required',
            'question' => 'required',
            'image' => 'require'
        ]);

        $game = Game::create([
            'is_active' => $request->input('is_active'),
            'name' => $request->input('name'),
            'question' => $request->input('question'),
            'description' => $request->input('description'),
            'image' => $request->input('image')
        ]);
        return redirect()->route('games.index')->with('success', "The game <strong>$game->question</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);

        $params = [
            'title' => 'Game Detail',
            'game' => $game
        ];

        return view('admin.games.games_delete')->with($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);

        $params = [
            'title' => 'Edit game',
            'game' => $game
        ];

        return view('admin.games.games_edit')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('game.index')->with('warning', 'The game you requested for has not been found');
        }

        $this->validate($request, [
            'is_active' => 'required',
            'name' => 'required',
            'question' => 'required',
            'image' => 'require'
        ]);

        $game->is_active = $request->input('is_active');
        $game->name = $request->input('name');
        $game->question = $request->input('question');
        $game->image = $request->input('image');
        $game->description = $request->input('description');

        $game->save();

        return redirect()->route('games.index')->with('success', "The game <strong>$game->question</strong> has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('game.index')->with('warning', 'The game you requested for has not been found');
        }

        $game->delete();

        return redirect()->route('games.index')->with('success', "The game <strong>$game->queation</strong> has successfully been archived.");
    }
}
