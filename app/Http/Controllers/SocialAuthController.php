<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback() {
        $providerUser = Socialite::driver('facebook')->user();

        $user = User::where('fb_id', $providerUser->id)->first();
        if (is_null($user) ) {
            $user = $this->updateUser($providerUser);
        }

        Auth::login($user);

        return redirect('idea/next')
            ->withCookie(cookie()->forever('id', $user->id));
    }

    private function updateUser($providerUser) {
        $user = User::find(Cookie::get('id'));
        $user->name = $providerUser->name;
        $user->email = is_null($providerUser->email) ? bcrypt(str_random(10))."@".str_random(10).".com" : $providerUser->email;
        $user->fb_id = $providerUser->id;
        $user->fb_url = $providerUser->profileUrl;
        $user->password = bcrypt(str_random(10));
        $user->save();

        return $user;
    }

}
