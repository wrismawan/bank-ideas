<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAction extends Model
{
    protected $table = "user_actions";

    public static $LIMIT = 5;

    public static function count() {
        return UserAction::where('user_id', Auth::id())->count();
    }
}
