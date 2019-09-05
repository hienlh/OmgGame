<?php

namespace OmgGame\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $getInfo = Socialite::driver($provider)->user();
        return $getInfo;
    }
}
