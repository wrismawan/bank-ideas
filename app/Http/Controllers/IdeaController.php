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

    public function showFunFacts()
    {

        $data['funfact'] = [
            ['url_image' => 'img/funfact/1.gif', 'fact' => 'We pay salary, but we don’t take any'],
            ['url_image' => 'img/funfact/2.gif', 'fact' => 'Mid 20’s, young and Entrepreneurs too but we don’t have a girlfriend'],
            ['url_image' => 'img/funfact/3.gif', 'fact' => 'Talk about millions and billions when we even don’t have thousands.'],
            ['url_image' => 'img/funfact/4.gif', 'fact' => 'Business plan document, plan about what?'],
            ['url_image' => 'img/funfact/5.gif', 'fact' => 'We say F word more often when we become founder'],
            ['url_image' => 'img/funfact/6.gif', 'fact' => 'Too many biography need to be read'],
            ['url_image' => 'img/funfact/7.gif', 'fact' => 'Felt comfortable to sleep with laptop rather than the pillow'],
            ['url_image' => 'img/funfact/8.gif', 'fact' => 'Build startup: drive so far, in the winding road, without certain destination'],
            ['url_image' => 'img/funfact/9.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/10.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/11.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/12.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/13.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/14.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/15.jpeg', 'fact' => '']
        ];

        $data['idx'] = rand(0,14);

        return view('show_funfacts')->with($data);

    }

    public function next(Request $request) {
        $nextIdea = Idea::next();
        $countAction = UserAction::count();

        if (is_null($nextIdea)) {
            return view('finish')->with('idea_count', $countAction);
        } else if ($countAction != 0 && $countAction % UserAction::$LIMIT == 0) {
            return view('want_more')->with('idea_count', $countAction);
        } else {
            return redirect()->route('idea.show', [$nextIdea->id])->with('message', $request->message);
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
        $newIdea->owner = $request->owner;
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
