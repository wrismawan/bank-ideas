<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Idea extends Model
{
    protected $table = "ideas";

    public $fillable = ['name','description'];

    public static function next() {
        $userActions = \App\UserAction::where('user_id', Auth::id())->get();
        $ideas = [];
        foreach ($userActions as $userAction) { array_push($ideas, $userAction->idea_id); }
        return Idea::whereNotIn('id', $ideas)->orderBy('viewed')->first();
    }

}
