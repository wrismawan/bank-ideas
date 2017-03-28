<?php

namespace App\Http\Middleware;

use App\UserAction;
use Closure;
use Illuminate\Support\Facades\Cookie;

class CountActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $count = UserAction::where('user_id', Cookie::get('id'))->get()->count();
        return redirect()->route('idea.needlogin');
//        if ($count >= UserAction::$LIMIT) {
//
//
//        }
//
//        return $next($request);
    }
}
