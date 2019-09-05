<?php

namespace OmgGame\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->user();
        // return redirect()->to('/?info=' . json_encode($getInfo));
        return view('fb_login_success');
    }
}
