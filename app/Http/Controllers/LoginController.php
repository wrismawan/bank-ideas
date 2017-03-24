<?php

namespace App\Http\Controllers;

use App\Exceptions\SocialAuthException;
use App\LoginUser;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginuser;

    public  function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function showIdea()
    {
        return redirect()->route('ten_idea');
    }

    public function auth($provider)
    {
        return $this->loginUser->authenticate($provider);
    }

    public function login($provider)
    {
        try {
            $this->loginuser->login($provider);
            return redirect()->action('LoginContoller@showIdea');
        } catch (SocialAuthException $e) {
            return redirect()->action('LoginContoller@showLoginPage')
                ->with('flash-message', $e->getMessage());
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }

}
