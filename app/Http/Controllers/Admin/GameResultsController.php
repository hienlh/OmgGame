<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use OmgGame\Helpers\Firebase\FirebaseHelper;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\GameResult;

class GameResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $game_id
     * @return Response
     */
    public function index($game_id)
    {
        $result = GameResult::all()->where('game_id', $game_id);
        $game = Game::findOrFail($game_id);

        $params = [
            'results' => $result,
            'game' => $game
        ];

        return view('admin.gameResults.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $game_id
     * @return Response
     */
    public function create($game_id)
    {
        $game = Game::findOrFail($game_id);
        return view('admin.gameResults.create', ['game' => $game]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $game_id
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request, $game_id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        if (!$request->hasFile('imageBackground')) {
            return redirect()
                ->back()
                ->withFlashDanger('The game result image background is required.');
        }

        $result = GameResult::create([
            'game_id' => $game_id,
            'image' => FirebaseHelper::getInstance()->upload($request->imageBackground, 'results'),
            'description' => $request->input('description'),
            'design' => $request->input('design') ?? "",
        ]);
        return redirect()->route('admin.gameResults.index', [$game_id])->withFlashSuccess("The game <strong>$result->result</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param $game_id
     * @param $result_id
     * @return Response
     */
    public function show($game_id, $result_id)
    {
        $result = GameResult::findOrFail($result_id);
        $game = Game::findOrFail($game_id);
        $params = [
            'result' => $result,
            'game' => $game
        ];
        return view('admin.gameResults.show')->with($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $game_id
     * @param $result_id
     * @return Response
     */
    public function edit($game_id, $result_id)
    {
        $result = GameResult::findOrFail($result_id);
        $game = Game::findOrFail($game_id);
        $params = [
            'result' => $result,
            'game' => $game
        ];
        return view('admin.gameResults.edit')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $game_id
     * @param $result_id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $game_id, $result_id)
    {
        $result = GameResult::find($result_id);
        if (!$result) {
            return redirect()
                ->route('admin.gameResults.index', $game_id)
                ->withFlashDanger('The game result you requested for has not been found.');
        }
        if (!$request->hasFile('imageBackground') && !$result->image) {
            return redirect()
                ->route('admin.gameResults.index', $game_id)
                ->withFlashDanger('The game result image is required.');
        }
        $this->validate($request, [
            'description' => 'required',
            'imageBackground' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $image_file = $request->imageBackground;
        $old_image = $result->image;

        $result->game_id = $game_id;
        if($image_file) $result->image = FirebaseHelper::getInstance()->upload($image_file, 'results');
        $result->description = $request->input('description');
        $result->design = $request->input('design') ?? "";
        $result->save();

        if ($image_file && $old_image && $old_image != $result->image) {
            FirebaseHelper::getInstance()->delete($old_image);
        }

        return redirect()->route('admin.gameResults.index', [$game_id])->withFlashSuccess("The result has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $game_id
     * @param $result_id
     * @return Response
     */
    public function destroy($game_id, $result_id)
    {
        $result = GameResult::find($result_id);
        if (!$result) {
            return redirect()
                ->route('admin.gameResults.index')
                ->withFlashDanger('The game result you requested for has not been found.');
        }
        $result->delete();
        return redirect()->route('admin.gameResults.index', [$game_id])->withFlashSuccess("The result has successfully been archived.");
    }
}
