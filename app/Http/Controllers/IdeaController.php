<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show($id) {
        $data['idea'] = Idea::find($id);

        return view('show_idea')->with($data);
    }

    public function store(Request $request) {

        $newIdea = new Idea();
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->save();

        return back();
    }

    public function like(Request $request) {
        $idea = Idea::find($request->id);
        $idea->like = $idea->like + 1;
        $idea->save();

        return back();
    }
}
