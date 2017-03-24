<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback() {
        $providerUser = Socialite::driver('facebook')->user();
        $user = User::where('email', $providerUser->user['email'])->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = $providerUser->user['name'];
            $user->email = $providerUser->user['email'];
            $user->fb_id = $providerUser->user['id'];
            $user->password = bcrypt(str_random(10));
            $user->save();
        }
        Auth::login($user);
        return redirect()->route('idea.next');
    }

}
