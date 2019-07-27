<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use OmgGame\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
