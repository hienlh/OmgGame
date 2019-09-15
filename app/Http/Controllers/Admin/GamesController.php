<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use OmgGame\Helpers\Firebase\FirebaseHelper;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\InfoForm;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $games = Game::all()->where('user_id', Auth::user()->id);

        return view('admin.games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $info_forms = InfoForm::all();

        $params = [
            'title' => 'Create Game',
            'info_forms' => $info_forms
        ];

        return view('admin.games.create')->with($params);
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
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $user = Auth::user();
        $game = Game::create([
            'is_active' => false,
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'question' => $request->input('question'),
            'description' => $request->input('description'),
            'image' => FirebaseHelper::getInstance()->upload($request->image, 'games'),
        ]);

        if ($request->has('info_forms')) {
            $game->info_forms()->attach($request->get('info_forms'));
        }
        return redirect()->route('admin.games.index')->withFlashSuccess("The game <strong>$game->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $info_forms = InfoForm::all();
        $game = Game::findOrFail($id);

        $params = [
            'game' => $game,
            'info_forms' => $info_forms
        ];

        return view('admin.games.show')->with($params);
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
        $info_forms = InfoForm::all();

        $params = [
            'game' => $game,
            'info_forms' => $info_forms
        ];

        return view('admin.games.edit', $params);
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
            return redirect()->back()->withInput($request->input())->with('flash_warning', 'The game you requested for has not been found');
        }

        if (count($game->results) <= 0 && $request->input('is_active')) {
            return redirect()->back()->withInput($request->input())->with('flash_warning', 'Only active game have at least one result.');
        }

        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if (!$request->hasFile('imageBackground') && !$game->image) {
            return redirect()
                ->back()
                ->with('flash_warning', 'The game result image is required.');
        }

        $image_file = $request->image;
        $old_image = $game->image;

        $game->is_active = $request->input('is_active') ? true : false;
        $game->name = $request->input('name');
        $game->question = $request->input('question');
        if ($image_file) $game->image = FirebaseHelper::getInstance()->upload($image_file, 'games');
        $game->description = $request->input('description');

        $game->save();

        if ($image_file && $old_image && $old_image != $game->image) {
            FirebaseHelper::getInstance()->delete($old_image);
        }

        if ($request->has('info_forms')) {
            $game->info_forms()->detach();
            $game->info_forms()->attach($request->get('info_forms'));
        }

        return redirect()->route('admin.games.index')->withFlashSuccess("The game <strong>$game->name</strong> has successfully been updated.");
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
            return redirect()->route('admin.games.index')->withFlashDanger('The game you requested for has not been found!');
        }

        $game->delete();

        return redirect()->route('admin.games.index')->withFlashSuccess("The game <strong>$game->name</strong> has successfully been archived.");
    }
}
