<?php

namespace OmgGame\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return redirect()->to('https://loginsuccess');
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->user();
        // return redirect()->to('/?info=' . json_encode($getInfo));
        return redirect()->to('https://loginsuccess');
    }
}
