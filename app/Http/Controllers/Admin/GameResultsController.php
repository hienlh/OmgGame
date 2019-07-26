<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\GameResult;

class GameResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result = GameResult::all();

        $params = [
            'title' => 'Game results Listing',
            'gameResult' => $result
        ];

        return view('admin.gameResults.gameResults_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'title' => 'Create new game result'
        ];

        return view('admin.gameResults.gameResults_create')->with($params);
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
            'game_id' => 'required',
            'image' => 'required',
            'result' => 'required',
        ]);

        $result = GameResult::create([
            'game_id' => $request->input('game_id'),
            'image' => $request->input('image'),
            'result' => $request->input('result'),
        ]);
        return redirect()->route('gameResults.index')->with('success', "The game <strong>$result->result</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $result = GameResult::find($id);
        $params = [
            'title' => 'Delete Game Result',
            'gameResult' => $result
        ];
        return view('admin.gameResults.gameResults_delete')->with($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $result = GameResult::find($id);
        $params = [
            'title' => 'Edit game result',
            'gameResult' => $result
        ];
        return view('admin.gameResults.gameResults_edit')->with($params);
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
        $result = GameResult::find($id);
        if (!$result) {
            return redirect()
                ->route('gameResults.index')
                ->with('warning', 'The game result you requested for has not been found.');
        }
        $this->validate($request, [
            'game_id' => 'required',
            'image' => 'required',
            'result' => 'required',
        ]);
        $result->game_id = $request->input('game_id');
        $result->image = $request->input('image');
        $result->result = $request->input('result');
        $result->save();
        return redirect()->route('gameResults.index')->with('success', "The result has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = GameResult::find($id);
        if (!$result) {
            return redirect()
                ->route('gameResults.index')
                ->with('warning', 'The game result you requested for has not been found.');
        }
        $result->delete();
        return redirect()->route('gameResults.index')->with('success', "The result has successfully been archived.");
    }
}
