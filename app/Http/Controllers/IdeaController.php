<?php

namespace App\Http\Controllers;

use App\Idea;
use App\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function show($id) {
        $data['idea'] = Idea::find($id);
        $this->updateCounter($id, 'viewed');
        return view('show_idea')->with($data);
    }

    public function next() {
        $nextIdea = Idea::next();
        $countAction = UserAction::count();

        if (is_null($nextIdea)) {
            return view('finish')->with('idea_count', $countAction);
        } else if ($countAction != 0 && $countAction % UserAction::$LIMIT == 0) {
            return view('want_more')->with('idea_count', $countAction);
        } else {
            return redirect()->route('idea.show', [$nextIdea->id]);
        }
    }

    public function trySubmit() {
        return view('coming_soon');
    }

    public function wantMore() {
        $nextIdea = Idea::next();

        if (is_null($nextIdea)) {
            return view('finish')->with('idea_count', Idea::all()->count());
        } else {
            return redirect()->route('idea.show', [$nextIdea->id]);
        }

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

        if ($type != 'viewed') {
            $value = $type == 'like' ? 1 : -1;
            $this->addAction($id, $value);
        }
    }

    private function addAction($idea_id, $value) {
        $action = new UserAction();
        $action->user_id = Auth::id();
        $action->idea_id = $idea_id;
        $action->val = $value;
        $action->save();
    }


}
