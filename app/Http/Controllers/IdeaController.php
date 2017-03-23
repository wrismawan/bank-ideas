<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Request $request) {
        return view('show_idea');
    }

    public function store(Request $request) {

        $newIdea = new Idea();
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->save();

        return back();
    }
}
