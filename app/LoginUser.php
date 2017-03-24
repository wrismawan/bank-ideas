<?php
/**
 * Created by PhpStorm.
 * User: ridhofh
 * Date: 24/03/17
 * Time: 8:34
 */

namespace App;


use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

class LoginUser
{
    public function authenticate($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function login($provider)
    {
        try {
            $socialUserInfo = Socialite::driver($provider)->user();
            $user = User::firstOrCreate(['email' => $socialUserInfo->getEmail()]);

            $socialProfile = $user->socialProfile ?: new SocialLoginProfile;
            $providerField = "{$provider}_id";
            $socialProfile->{$providerField} = $socialUserInfo->getId();
            $user->socialProfile()->save($socialProfile);
            auth()->login($user);
        } catch (Exception $e) {
            throw new SocialAuthException("failed to authenticate with $provider");
        }
    }
}