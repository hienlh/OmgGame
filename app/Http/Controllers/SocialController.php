<?php

namespace OmgGame\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider, $id)
    {
        Session::put('userfbid', $id);
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
        try {
            $client= new Client();
            $client->post('http://omg-support-server.herokuapp.com/login-success', [
                'form_params' => [
                    'id' => Session::get('userfbid')
                ]
            ]);
        } catch (GuzzleException $e) {
        }
        return view('fb_login_success');
    }
}
