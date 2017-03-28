<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{
    public function getCookie(Request $request) {
        return Cookie::get('id');
    }

    public function setCookie(Request $request) {
        $uuid = Uuid::uuid4()->toString();
        return response("Set Cookie {$uuid}")->cookie('id', $uuid);
    }

    public function clearCookie(Request $request) {
        return Cookie::queue(Cookie::forget('id'));
    }
}
