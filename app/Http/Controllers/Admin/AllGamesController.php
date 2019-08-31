<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\User;

class AllGamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:games');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $games = Game::all();

        return view('admin.games.index')->with('games', $games);
    }
}
