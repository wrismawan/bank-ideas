<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAction extends Model
{
    protected $table = "user_actions";

    public static $TRIAL_LIMIT = 5;
    public static $LIMIT = 10;

    public static function count($user_id) {
        return UserAction::where('user_id', $user_id)->count();
    }
}
