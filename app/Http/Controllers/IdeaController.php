<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show($id) {
        $data['idea'] = Idea::find($id);
        $this->updateCounter($id, 'viewed');
        return view('show_idea')->with($data);
    }

    public function next() {
        $nextIdea = Idea::next();
        return redirect()->route('idea.show', [$nextIdea->id]);
    }

    public function store(Request $request) {
        $newIdea = new Idea();
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->save();
        return back();
    }

    public function like(Request $request) {
        $this->updateCounter($request->id, 'like');
        return redirect()->route('idea.next');
    }

    public function skip(Request $request) {
        $this->updateCounter($request->id, 'skip');
        return redirect()->route('idea.next');
    }

    private function updateCounter($id, $type) {
        $idea = Idea::find($id);
        $idea->{$type} = $idea->{$type} + 1;
        $idea->save();
    }
}
