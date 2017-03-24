<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback() {
        $providerUser = Socialite::driver('facebook')->user();
        dd($providerUser->user);
        $user = new User();
        $user->name = $providerUser->user;
        $user->email = $providerUser->email;
    }
}
