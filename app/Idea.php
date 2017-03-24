<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = "ideas";

    public $fillable = ['name','description'];

    public static function next() {
        return Idea::orderBy('viewed')->first();
    }
}
