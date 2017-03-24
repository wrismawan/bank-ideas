<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = "ideas";

    public static function next() {
        return Idea::orderBy('viewed')->first();
    }
}
